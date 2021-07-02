<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentBanner;
use App\Traits\AwsTrait;
use App\Traits\ResponseTrait;
use App\Http\Requests\ManageTournamentRequest;
use Illuminate\Http\Request;



class ManageTournamentController extends Controller
{

    public $listSystemTour = [
        1 => "Master",
        2 => "Open",
        3 => "National Championship",
        4 => "Tour Championship",
        5 => "Classic",
        6 => "Challenge",
        7 => "Cup",
        8 => "Matchplay Championship",
        9 => "Tournament",
        10 => "King cup"
    ];

    use AwsTrait, ResponseTrait;

    public function index(Request $request)
    {

        $tourId = $request->tour_id;

        if ($tourId === null) {

            $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                ->where('is_active', 1)
                ->select('vgatour_tournament.*', 'facility.sub_title')
                ->first();

            if ($tour == null) {

                $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                    ->select('vgatour_tournament.*', 'facility.sub_title')
                    ->orderBy('created_at', 'desc')
                    ->first();
            }

            $tourId = $tour->id;
        } else {
            $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                ->where('vgatour_tournament.id', $tourId)
                ->select('vgatour_tournament.*', 'facility.sub_title')
                ->first();
        }

        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('type', 8)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        $listSponsor = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
            ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tour_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('type', 7)
            ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
            ->get();

        $listSystemTour = $this->listSystemTour;


        return view('cms.manage_tournament.index', compact('listBanner', 'tourId', 'tour', 'listSponsor', 'listSystemTour'));
    }


    public function create()
    {
        $listSystemTour = $this->listSystemTour;

        return view('cms.manage_tournament.create', ['listSystemTour' => $listSystemTour]);
    }

    public function store(ManageTournamentRequest $request)
    {


        $data = $request->all();



        // $validator = Validator::make($data, [
        //     'url.*' => 'required|distinct|min:3',
        // ]);
        // if ($validator->fails()) {
        //     //  flash(__(''))->success();

        // }

        $tour = new Tournament($data);

        $result = $tour->save();

        $listImage = $request->link_image;
        $sizes = config('image.tournament');



        foreach ($listImage as $key => $image) {

            $banner = new TournamentBanner();
            $banner->tour_id = $tour->id;
            $banner->type = $request->type[$key];
            $banner->url = $request->url[$key];
            $pos = ($request->type[$key] == 8) ? 'cover' : 'sponsor';
            $banner->link_image = $this->uploadImage($image, "image_upload", $pos, $sizes[$pos]['width'], $sizes[$pos]['height']);
            $banner->upload_by = auth()->user()->id;

            $banner->save();
        }

        if ($result) {
            flash(__('themgiaidauthanhcong'))->success();
        } else {
            flash(__('themgiaidauthatbai'))->danger();
        }

        return redirect()->route('manage_tour.index', ["tour_id" => $tour->id]);
    }

    public function update(Request $request, $id)
    {

        $isAjax = ($request->has('is_ajax')) ? true : false;

        $tour = Tournament::where('id', $request->tour_id)->first();

        if ($isAjax) {

            $tour->is_active = $request->is_active;
            $result = $tour->save();

            if ($request->is_active == 1) {

                $olderTour = Tournament::where('is_active', 1)->where('id', '!=', $request->tour_id)->first();

                if ($olderTour) {
                    $olderTour->is_active = 0;
                    $olderTour->save();
                }
            }

            if ($result) {
                return $this->handleResponse(0, 0, array('message' => __('suagiaidauthanhcong')));
            } else {
                return $this->handleResponse(1, 0, array('message' => __('suagiaidauthatbai')));
            }
        } else {

            $data = $request->all();

            $tour = Tournament::where('id', $id)->first();
            if ($data['timer'] != '') {
                $data['timer'] = \Carbon\Carbon::parse($data['timer'])->format('Y-m-d H:i:s');
            }
            
            $tour->update($data);
            // $tour->timer = $data['timer'];

            $result = $tour->save();

            if ($request->has('link_image')) {
                $listImage = $request->link_image;

                $sizes = config('image.tournament');


                foreach ($listImage as $key => $image) {

                    $banner = new TournamentBanner();
                    $banner->tour_id = $tour->id;
                    $banner->type = $request->type[$key];
                    $banner->url = $request->url[$key];
                    $pos = ($request->type[$key] == 8) ? 'cover' : 'sponsor';
                    $banner->link_image = $this->uploadImage($image, "image_upload", $pos, $sizes[$pos]['width'], $sizes[$pos]['height']);
                    $banner->upload_by = auth()->user()->id;

                    $banner->save();
                }
            }

            if ($result) {
                flash(__('suagiaidauthanhcong'))->success();
            } else {
                flash(__('suagiaidauthatbai'))->danger();
            }

            return redirect()->route('manage_tour.index', ['tour_id' => $id]);
        }
    }

    public
    function addViewUpload(Request $request)
    {
        $pos = $request->pos;
        $type = $request->type;

        return view('cms.manage_tournament.template.view_upload_banner', compact('pos', 'type'));
    }
}
