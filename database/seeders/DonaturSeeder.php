<?php

namespace Database\Seeders;

use App\Models\Donatur;
use Illuminate\Database\Seeder;

class DonaturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donatur::factory()->count(1000)->create();
    }
}
