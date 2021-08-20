<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDonasi extends Model
{
    use HasFactory;

    protected $table = "jenis_donasi";

    protected $guarded = [];

    public function setMinimumDonasiAttribute($value)
    {
        $this->attributes['minimum_donasi'] = str_replace(".","",$value);
    }

    public function getMinimumDonasiAttribute($value)
    {
        return number_format($value, 0, "", ".");
    }
}
