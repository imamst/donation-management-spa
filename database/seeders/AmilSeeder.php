<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('amil')->insert([
            [
                'nama' => 'Amil Jr',
                'role' => 1,
                'status' => true,
                'email' => 'amil.junior@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'nama' => 'Amil Sr',
                'role' => 2,
                'status' => true,
                'email' => 'amil.senior@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'nama' => 'Admin',
                'role' => 3,
                'status' => true,
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'nama' => 'Super Admin',
                'role' => 4,
                'status' => true,
                'email' => 'super.admin@example.com',
                'password' => Hash::make('12345678'),
            ]
        ]);

    }
}
