<?php

namespace App\Traits;

use App\Models\SystemTour;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;

trait TourTrait
{

    protected function getDataTour($tourId = null)
    {
        if ($tourId === null) {

            $tour = Tournament::where('is_active', 1)->first();

            if ($tour == null) {

                $tour = Tournament::leftJoin('facility', 'facility.id', 'facility_id')
                    ->select('vgatour_tournament.*', 'facility.sub_title')
                    ->orderBy('created_at', 'desc')
                    ->first();
            }

        } else {
            $tour = Tournament::where('id', $tourId)->first();
        }

        return $tour;
    }
}
