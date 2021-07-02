<?php

namespace App\Http\Controllers;

use App\Models\Athletic;
use App\Models\Tournament;
use App\Models\TournamentBanner;
use App\Models\TournamentHasDate;
use App\Traits\TourTrait;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use TourTrait;

    public function index(Request $request)
    {

        $tourId = $request->tour;

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

        $listDate = TournamentHasDate::where('tournament_id', $tourId)->get();

        return view('schedule.index', compact('listBanner', 'listDate', 'tour', 'tourId'));
    }
}
