<?php

namespace App\Http\Controllers;

use App\State;
use App\City;

class StatesController extends Controller
{
    function list() {
        return State::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function cities($state_id)
    {
        return City::where('state_id', $state_id)
            ->orderBy('name', 'asc')
            ->get();
    }
}
