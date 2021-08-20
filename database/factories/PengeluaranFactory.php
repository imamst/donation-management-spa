<?php

namespace Database\Factories;

use App\Models\Pengeluaran;
use App\Models\JenisPengeluaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengeluaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengeluaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $serial = 1;
        $jenis_pengeluaran = JenisPengeluaran::all()->random();

        return [
            'tgl_keluar' => $this->faker->dateTimeBetween($startDate = '-5 months', $endDate = 'now'),
            'nama_penerima' => $this->faker->name,
            'id_amil' => 1,
            'nama_amil' => 'Super Admin',
            'id_jenis_pengeluaran' => $jenis_pengeluaran->id,
            'nama_jenis_pengeluaran' => $jenis_pengeluaran->nama,
            'nominal' => $this->faker->numberBetween(100000, 1000000),
            'no_kwitansi' => $serial++,
            'keterangan' => null
        ];
    }
}
