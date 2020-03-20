<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;

class City extends Model
{
	protected $fillable = ['state_id', 'name', 'ibge_id'];

    public function state()
    {
    	return $this->belongsTo(State::class);
    }
}
