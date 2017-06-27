<?php

// Created by lupix. All rights reserved.

use App\Entities\Callout;
use Illuminate\Database\Seeder;

class CalloutTableSeeder extends Seeder
{
    public function run()
    {
        $callouts = [
            ['id' => 1, 'name' => 'CT Spawn'],
            ['id' => 2, 'name' => 'Mid'],
            ['id' => 3, 'name' => 'Long A'],
            ['id' => 4, 'name' => 'Short A']
        ];

        Callout::insert($callouts);
    }
}