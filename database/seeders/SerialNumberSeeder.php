<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerialNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serial_number_holder')->insert(
            [
                [
                    'id' => 1,
                    'nama' => 'donasi',
                    'serial' => 0
                ],
                [
                    'id' => 2,
                    'nama' => 'pengeluaran',
                    'serial' => 0
                ]
            ]);
    }
}
