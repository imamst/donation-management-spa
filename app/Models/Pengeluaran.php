<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $guarded = [];
    protected $dates = ['tgl_keluar'];
    protected $appends = ['nominal_rupiah'];

    public function getTglKeluarAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getNominalRupiahAttribute()
    {
        return number_format($this->nominal, 0, "", ".");
    }

    public function setNominalAttribute($value)
    {
        $this->attributes['nominal'] = str_replace(".","",$value);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function scopeIndex($query)
    {
        return $query->select('id', 'tgl_keluar', 'nama_penerima', 'nama_amil', 'nama_jenis_pengeluaran', 'nominal', 'no_kwitansi', 'created_at')->orderBy('tgl_keluar', 'desc')->orderBy('id', 'desc');
    }

    public function scopeIndexByDate($query, $date)
    {
        return $query->whereDate('tgl_keluar', $date)
                    ->select('id', 'tgl_keluar', 'nama_penerima', 'nama_amil', 'nama_jenis_pengeluaran', 'nominal', 'no_kwitansi', 'created_at')
                    ->orderBy('tgl_keluar', 'desc')->orderBy('id', 'desc');
    }

    public function scopeIndexByMonth($query, $value)
    {
        return $query->whereMonth('tgl_keluar', $value)
                    ->select('id', 'tgl_keluar', 'nama_penerima', 'nama_amil', 'nama_jenis_pengeluaran', 'nominal', 'no_kwitansi', 'created_at')
                    ->orderBy('tgl_keluar', 'desc')->orderBy('id', 'desc');
    }

    public function scopeCountByMonth($query, $value)
    {
        return $query->whereMonth('tgl_keluar', $value)->count();
    }

    public function scopeSumNominalByMonth($query, $value)
    {
        return $query->whereMonth('tgl_keluar', $value)->sum('nominal');
    }

    public function scopeSearch($query, $category, $keyword)
    {
        return $query->where(function($query) use ($category, $keyword) {
            $query->whereRaw('UPPER('.$category.') LIKE ?', ['%'.strtoupper($keyword).'%']);
        })->select('id', 'tgl_keluar', 'nama_penerima', 'nama_amil', 'nama_jenis_pengeluaran', 'nominal', 'no_kwitansi', 'created_at')->orderBy('tgl_keluar', 'desc')->orderBy('id', 'desc');
    }
}
