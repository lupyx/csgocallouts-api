<?php

// Created by lupix. All rights reserved.

use App\Entities\Callout;
use Illuminate\Database\Seeder;

class CalloutTableSeeder extends Seeder
{
    public function run()
    {
        $callouts = [
            ['name' => 'CT Spawn']
        ];

        Callout::insert($callouts);
    }
}