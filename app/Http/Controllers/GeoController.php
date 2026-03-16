<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\City;

class GeoController extends Controller
{

    public function states($countryId)
    {
        $states = State::where('country_id',$countryId)
                    ->select('id','name')
                    ->orderBy('name')
                    ->get();

        return response()->json($states);
    }

    public function cities($stateId)
    {
        $cities = City::where('state_id',$stateId)
                    ->select('id','name')
                    ->orderBy('name')
                    ->get();

        return response()->json($cities);
    }

}