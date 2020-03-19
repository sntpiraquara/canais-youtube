<?php

use App\State;
use App\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
    	$states = State::select('id', 'ibge_id')
                    ->orderBy("ibge_id", 'asc')
					->get()
                    ->reduce(function ($carry, $state) {
                        return array_merge($carry, ["{$state->ibge_id} " => $state->id]);
                    }, []);

        $cities = json_decode(file_get_contents(database_path('cities.json')));
        $cities = collect($cities)->map(function ($city, $key) use ($states) {
			return [
				"name" => $city->name,
				"ibge_id" => $city->id,
				"state_id" => $states["$city->state_id "],
            ];
		});	

        $chunks = $cities->chunk(500);
        foreach ($chunks as $chunk) {
        	City::insert($chunk->toArray());
        }
    }
}
