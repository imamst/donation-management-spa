<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\JenisDonasi;

class MinimumDonation implements Rule
{
    protected $id_jenis_donasi;
    protected $minimum_donasi;

    public function __construct($id_jenis_donasi)
    {
        $this->id_jenis_donasi = $id_jenis_donasi;
    }

    public function passes($attribute, $value)
    {
        $jenis_donasi = JenisDonasi::findOrFail($this->id_jenis_donasi);
        $nominal = str_replace('.','',$value);
        $this->minimum_donasi = $jenis_donasi->minimum_donasi;

        return $nominal >= str_replace('.','',$this->minimum_donasi);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nominal donasi minimum Rp '.$this->minimum_donasi;
    }
}
