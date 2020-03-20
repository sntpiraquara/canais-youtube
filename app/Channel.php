<?php

namespace App;

use App\City;
use App\State;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['state_id', 'city_id', 'youtube_url'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
