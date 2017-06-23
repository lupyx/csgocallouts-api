<?php

// Created by lupix. All rights reserved.

use App\Entities\Map;
use Illuminate\Database\Seeder;
class MapTableSeeder extends Seeder
{
    public function run()
    {
        $maps = [
            ['id' => 1,'name' => 'Dust II'],
            ['id' => 2,'name' => 'Inferno'],
            ['id' => 3,'name' => 'Cobblestone'],
            ['id' => 4,'name' => 'Overpass'],
            ['id' => 5,'name' => 'Cache'],
            ['id' => 6,'name' => 'Mirage'],
            ['id' => 7,'name' => 'Nuke'],
            ['id' => 8,'name' => 'Train'],
        ];

        Map::insert($maps);
    }
}