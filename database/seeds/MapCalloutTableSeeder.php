<?php

// Created by lupix. All rights reserved.

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapCalloutTableSeeder extends Seeder
{
    public function run()
    {
        $mapCallouts = [
            ['map_id' => 1, 'callout_id' => 1],
            ['map_id' => 2, 'callout_id' => 1],
            ['map_id' => 3, 'callout_id' => 1],
            ['map_id' => 4, 'callout_id' => 1],
            ['map_id' => 5, 'callout_id' => 1],
            ['map_id' => 6, 'callout_id' => 1],
            ['map_id' => 7, 'callout_id' => 1],
            ['map_id' => 8, 'callout_id' => 1],

        ];

        DB::table('maps_callouts')->insert($mapCallouts);
    }
}