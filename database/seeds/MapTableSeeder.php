<?php

// Created by lupix. All rights reserved.

use App\Entities\Map;
use Illuminate\Database\Seeder;
class MapTableSeeder extends Seeder
{
    public function run()
    {
        $maps = [
            ['name' => 'Dust II'],
            ['name' => 'Inferno'],
            ['name' => 'Cobblestone'],
            ['name' => 'Overpass'],
            ['name' => 'Cache'],
            ['name' => 'Mirage'],
            ['name' => 'Nuke'],
            ['name' => 'Train'],
        ];

        Map::insert($maps);
    }
}