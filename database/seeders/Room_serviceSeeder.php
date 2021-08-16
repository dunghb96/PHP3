<?php

namespace Database\Seeders;

use App\Models\Room_service;
use Illuminate\Database\Seeder;

class Room_serviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room_service::factory(5)->create();
    }
}
