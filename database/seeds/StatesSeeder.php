<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    public function run()
    {
        $states = json_decode(file_get_contents(database_path('states.json')));
        $states = collect($states)->map(function ($state, $key) {
			return [
                'name'    => $state->name,
                'slug'    => $state->abbr,
                'ibge_id' => $state->id,
            ];
		});

        State::insert($states->toArray());
    }
}
