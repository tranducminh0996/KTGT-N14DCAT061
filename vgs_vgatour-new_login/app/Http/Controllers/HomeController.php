<?php

namespace App\Http\Controllers;

use App\Models\Admin\Post;
use App\Models\Admin\Video;
use App\Models\Tournament;
use App\Models\TournamentBanner;
use App\Traits\TourTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    use TourTrait;

    // public function changeLanguage($language)
    // {
    //     Session::put('website_language', $language);

    //     return redirect()->back();
    // }

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
                       

        $listPost = Post::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_posts.tournament_id')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tournament_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->where('format_type', 1)
            ->select('vgatour_posts.*')
            ->orderBy('order', 'desc')
            ->limit(4)
            ->get();


        $listVideo = Video::join('vgatour_tournament', 'vgatour_tournament.id', 'vgatour_videos.tournament_id')
            ->where(function ($q) use ($tourId) {
                if ($tourId !== null) {
                    $q->where('tournament_id', $tourId);
                } else {
                    $q->where('vgatour_tournament.is_active', 1);
                }
            })
            ->where('status', 1)
            ->select('vgatour_videos.*')
            ->orderBy('order', 'desc')
            ->limit(3)
            ->get();
            

        return view('home.index', compact('listBanner', 'tour', 'listPost', 'tourId', 'listVideo'));
    }
}
