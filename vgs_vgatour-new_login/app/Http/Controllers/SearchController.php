<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Facility;
use App\Models\Tournament;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function searchTour(Request $request)
    {
        $keyword = $request->keyword['term'];

        $listTour = Tournament::where('name', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($listTour);
    }

    public function searchFacility(Request $request)
    {
        $keyword = $request->keyword['term'];

        $listFacility = Facility::where('sub_title', 'like', '%' . $keyword . '%')
            ->where('country', 243)
            ->where('motor_cart', 0)
            ->select('id', 'sub_title')
            ->get();

        return response()->json($listFacility);
    }

    public function searchCountry(Request $request)
    {
        $keyword = $request->keyword['term'];

        $listTour = Country::where('name', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($listTour);
    }

}
