<?php

namespace App\Http\Controllers;

use App\Traits\TourTrait;
use Illuminate\Http\Request;
use App\Models\TournamentBanner;

class LivescoreController extends Controller
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

        return view('livescore.index', compact('tourId', 'tour', 'listBanner'));
    }
}
