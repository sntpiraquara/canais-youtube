<?php

use Illuminate\Support\Facades\Route;

Route::get('states/', 'StatesController@list');
Route::get('states/{state_id}/cities', 'StatesController@cities');

Route::get('channels', 'ChannelsController@list');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
