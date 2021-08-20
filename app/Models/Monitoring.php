<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';
    protected $primaryKey = 'id_amil';
    protected $guarded = [];
    // protected $appends = ['keterangan'];
    public $timestamps = FALSE;
    
    // public function getKeteranganAttribute()
    // {
    //     return $this->tgl_login == $this->tgl_logout ? "Sesi Habis" : "";
    // }

    public function scopeUpdateLoginAndLogoutTime($query, $amil)
    {
        return $query->firstOrCreate([
                        'id_amil' => $amil->id
                    ])->update([
                        'nama_amil' => $amil->nama,
                        'tgl_login' => date('Y-m-d H:i:s')
                    ]);
    }

    public function scopeUpdateLogoutTime($query, $amil)
    {
        return $query->firstOrCreate([
                        'id_amil' => $amil->id,
                    ])->update([
                        'nama_amil' => $amil->nama,
                        'tgl_logout' => date('Y-m-d H:i:s')
                    ]);
    }
}
