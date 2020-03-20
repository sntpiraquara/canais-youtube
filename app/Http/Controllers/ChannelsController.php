<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChannelsController extends Controller
{
    function list() {
        $key = 'channels';
        return Cache::rememberForever($key, function () {
            $channels = Channel::all();
            $channels->load([
                'state' => function ($query) {$query->select('id', 'name');},
                'city'  => function ($query) {$query->select('id', 'name');},
            ]);

            return $channels->map(function ($channel) {
                return [
                    'id'          => $channel->id,
                    'state'       => $channel->state->name,
                    'city'        => $channel->city->name,
                    'youtube_url' => $channel->youtube_url,
                ];
            });
        });
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'state' => 'required|exists:states,id',
            'city'  => 'required|exists:cities,id',
            'link'  => 'required|url',
        ]);

        $channel = Channel::select('id')
            ->where('youtube_url', $request->link)
            ->first();

        if ($channel) {
            return redirect('/')->with('duplicated', true);
        }

        $channel = Channel::create([
            'state_id'    => $request->state,
            'city_id'     => $request->city,
            'youtube_url' => $request->link,
        ]);

        Cache::forget('channels');

        return redirect('/')->with('success', true);
    }
}
