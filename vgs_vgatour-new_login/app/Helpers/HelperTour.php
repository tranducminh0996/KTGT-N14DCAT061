<?php

use App\Models\Facility;
use App\Models\SystemTour;
use App\Models\TournamentBanner;
use App\Models\TournamentHasDate;
use App\Models\Tournament;

use App\Repositories\Booking;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return env($key);
    }
}

if (!function_exists('getTimePost')) {
    function getTimePost($timeStart)
    {
        $start = \Carbon\Carbon::parse($timeStart);

        $interval = now()->diff($start);

        if ($interval->y > 0) {
            return __(':count namtruoc', ['count' => $interval->y]);
        } else {
            if ($interval->m > 0) {
                return __(':count thangtruoc', ['count' => $interval->m]);
            } else {

                if ($interval->d > 0) {
                    return __(':count ngaytruoc', ['count' => $interval->d]);
                } else {

                    if ($interval->h > 0) {
                        return __(':count giotruoc', ['count' => $interval->h]);
                    } else {
                        if ($interval->i > 0) {
                            return __(':count giotruoc', ['count' => $interval->i]);
                        } else {
                            return __('vuaxong');
                        }
                    }
                }
            }
        }
    }
}

if (!function_exists('getSystemTour')) {
    function getSystemTour()
    {

        $system_tour = SystemTour::with(['listTour' => function ($q) {
            $q->with('listDate');
            $q->with('listBanner');

        }])
            
            ->orderBy('id', 'asc')
            ->get();
            // echo '<pre>';
            // print_r($system_tour->toarray());
            // echo '</pre>';die();

        return $system_tour;
    }
}
if (!function_exists('getTourBanner')) {
    function getTourBanner($tourId, $type)
    {

        $tour_banner = TournamentBanner::where('tour_id',$tourId)
            ->where('type',$type)
            ->where('status', '1')
            ->select('link_image')
            ->get();
        // $tour_banner = $tour_banner->toarray();
        // $tour_banner = $tour_banner['0']['link_image']; 

        return  $tour_banner->first();
    }
}
if (!function_exists('getTourDate')) {
    function getTourDate($tourId)
    {
        $tour_date = TournamentHasDate::where('tournament_id',$tourId)
            ->select('date')
            ->orderBy('date', 'asc')
            ->get();
        $first = ($tour_date->count()>1)? date_parse($tour_date->first()['date']) ['day'] . " - " : "";
        $rs = $first . ($tour_date->count()>0)? date("d/m/Y", strtotime($tour_date->last()['date'])) : "";
        
        return  $rs;
    }
}
if (!function_exists('getfacility')) {
    function getLiveScoreSize($tourId)
    {
        $liveScoreSize = Tournament::where('id',$tourId)
            ->select('livescore_size')
            ->get();
        if($liveScoreSize!=NULL) return $liveScoreSize->first()->livescore_size;
        
        else return "1200";
    }
}
if (!function_exists('getFacility')) {
    function getFacility($facility_id)
    {
        $facility = Facility::where('id',$facility_id)
        ->select('sub_title')
        ->get();
        if($facility!=NULL) return $facility->first()->sub_title;
        
        else return "";
    }
}


