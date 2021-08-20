<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_donasi')->insert([
            [
                'id' => 1,
                'nama' => 'Wakaf',
                'minimum_donasi' => 50000000
            ],
            [
                'id' => 2,
                'nama' => 'Buka Puasa',
                'minimum_donasi' => 100000
            ],
            [
                'id' => 3,
                'nama' => 'Yatim Piatu',
                'minimum_donasi' => 500000
            ]
        ]);

    }
}
