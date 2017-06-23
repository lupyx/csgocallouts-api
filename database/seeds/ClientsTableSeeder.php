<?php

// Created by lupix. All rights reserved.

use App\Entities\ApiClient;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            ['name' => 'CSGOCallouts Website', 'api_token' => bin2hex(random_bytes(15))]
        ];

        ApiClient::insert($clients);
    }
}