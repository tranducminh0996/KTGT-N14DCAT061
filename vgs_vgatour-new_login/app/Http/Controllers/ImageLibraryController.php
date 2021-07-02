<?php

namespace App\Http\Controllers;

use App\Models\Admin\Video;
use App\Traits\TourTrait;
use App\Models\TournamentBanner;
use App\Models\Admin\Gallery ;
use Illuminate\Http\Request;

class ImageLibraryController extends Controller
{
    use TourTrait;

    public function index(Request $request)
    {
        $tourId = $request->tour;

        $tour = $this->getDataTour($tourId);

        $tourId = $tour->id;


        $listBanner = TournamentBanner::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_tournament_banner.tour_id')
        ->join('vgatour_admin', 'vgatour_admin.id', 'vgatour_tournament_banner.upload_by')
        ->where(function ($q) use ($tourId) {
            if ($tourId !== null) {
                $q->where('tour_id', $tourId);
            } else {
                $q->where('vgatour_tournament.is_active', 1);
            }
        })
        ->where('status', 1)
        ->select('vgatour_tournament_banner.*', 'vgatour_admin.name', 'vgatour_tournament.name as name_tour')
        ->get();

        // lấy list ảnh của giải ở đây

        $listImage = Gallery::where('tournament_id', $tourId)
        ->select('img_resize', 'img_url', 'img_convert')
        ->get()->toarray();
        // echo '<pre>';
        // print_r($listImage);
        // echo '</pre>';
        
      

        return view('imageLibrary.index', compact('listBanner', 'tourId', 'tour', 'listImage'));
    }
}
