<?php

namespace Database\Factories;

use App\Models\Donasi;
use App\Models\JenisDonasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $serial = 1;
        $jenis_donasi = JenisDonasi::all()->random();

        $arr_metode_donasi = ['Tunai', 'Barang', 'Overbook'];
        $metode_donasi = $arr_metode_donasi[array_rand($arr_metode_donasi)];

        return [
            'tgl_donasi' => $this->faker->dateTimeBetween($startDate = '-5 months', $endDate = 'now'),
            'id_donatur' => $this->faker->numberBetween(1, 1000),
            'nama_donatur' => $this->faker->name,
            'alamat_donatur' => $this->faker->address,
            'id_amil' => 1,
            'nama_amil' => 'Super Admin',
            'id_jenis_donasi' => $jenis_donasi->id,
            'nama_jenis_donasi' => $jenis_donasi->nama,
            'metode_donasi' => $metode_donasi,
            'nama_bank' => $this->getNamaBank($metode_donasi),
            'id_rekening' => null,
            'nama_rekening' => null,
            'nominal' => $this->faker->numberBetween(100000, 3000000),
            'no_kwitansi' => $serial++,
            'keterangan' => null
        ];
    }

    private function getNamaBank(String $metode_donasi) : String
    {
        $arr_bank_name = ['Mandiri', 'CIMB', 'BNI', 'BTPN Jenius', 'Maybank'];

        if($metode_donasi == 'Overbook') {
            return $arr_bank_name[array_rand($arr_bank_name)];
        }

        return '-';
    }
}
