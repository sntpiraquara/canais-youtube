<?php

use Illuminate\Database\Migrations\Migration;
use App\State;
use App\City;

class AddDfCidadesSatelites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $json = file_get_contents(database_path('df-satelites.json'));
        $cities = json_decode($json);

        $df = State::where('slug', 'DF')->first();
        foreach ($cities as $city) {
            City::create([
                'state_id' => $df->id,
                'name' => $city,
                'ibge_id' => 0
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
