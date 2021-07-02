<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentBanner;
use App\Models\TournamentHasDate;
use Illuminate\Http\Request;

class ManageScheduleTicketController extends Controller
{
//


    public function index(Request $request)
    {


        $tourId = $request->tour_id;

        if ($tourId === null) {

            $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                ->where('is_active', 1)
                ->select('vgatour_tournament.*', 'facility.sub_title', 'facility.address')
                ->first();

            if ($tour == null) {

                $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                    ->select('vgatour_tournament.*', 'facility.sub_title', 'facility.address')
                    ->orderBy('created_at', 'desc')
                    ->first();
            }

            $tourId = $tour->id;

        } else {
            $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                ->where('vgatour_tournament.id', $tourId)
                ->select('vgatour_tournament.*', 'facility.sub_title', 'facility.address')
                ->first();
        }

        $listDate = TournamentHasDate::where('tournament_id', $tourId)->get();

        return view('cms.manage_schedule_ticket.index', compact('tourId', 'tour', 'listDate'));
    }


    public function create()
    {

        return view('cms.manage_tournament.create');

    }

    public function store(Request $request)
    {

        $data = $request->all();

        $tour = new Tournament($data);

        $result = $tour->save();

        $listImage = $request->link_image;

        foreach ($listImage as $key => $image) {

            $banner = new TournamentBanner();
            $banner->tour_id = $tour->id;
            $banner->type = $request->type[$key];
            $banner->url = $request->url[$key];
            $banner->link_image = $this->uploadImage($image, "image_upload", ($request->type[$key] == 8) ? 'cover' : 'sponsor');
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

        $listDate = $request->date;

        $tour = Tournament::where('id', $id)->first();

        foreach ($listDate as $date) {

            $data = ['date' => $date, 'tournament_id' => $tour->id];

            $result = TournamentHasDate::insert($data);
        }


        if ($result) {
            flash(__('themngaygiaidauthanhcong'))->success();
        } else {
            flash(__('themngaygiaidauthatbai'))->danger();
        }

        return redirect()->route('manage_schedule_ticket.index', ['tour_id' => $id]);
    }

    public
    function addViewTicket(Request $request)
    {

        $tour = $request->tour;
        $address = $request->address;
        $facility = $request->facility;

        return view('cms.manage_schedule_ticket.template.item_schedule_ticket', compact('tour', 'address', 'facility'));

    }
}
