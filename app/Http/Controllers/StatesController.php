<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use Illuminate\Support\Facades\Cache;

class StatesController extends Controller
{
    function list() {
        $key = 'state-select';
        return Cache::rememberForever($key, function () {
            return State::select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();
        });
    }

    public function cities($state_id)
    {
        $key = 'city-select-' . $state_id;
        return Cache::rememberForever($key, function () use ($state_id) {
            return City::where('state_id', $state_id)
                ->orderBy('name', 'asc')
                ->get();
        });
    }
}
