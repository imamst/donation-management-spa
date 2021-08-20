<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AmilSeeder::class);
        $this->call(DonaturSeeder::class);
        $this->call(SerialNumberSeeder::class);
        $this->call(JenisDonasiSeeder::class);
        $this->call(DonasiSeeder::class);
        $this->call(JenisPengeluaranSeeder::class);
        $this->call(PengeluaranSeeder::class);
    }
}
