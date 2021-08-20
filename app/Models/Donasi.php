<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    protected $guarded = [];
    protected $appends = ['nominal_rupiah'];

    public function getTglDonasiAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getMetodeDonasiAttribute($value)
    {
        return ucwords($value);
    }

    public function getNominalRupiahAttribute()
    {
        return number_format($this->nominal, 0, "", ".");
    }

    public function setNominalAttribute($value)
    {
        $this->attributes['nominal'] = str_replace(".","",$value);
    }

    public function setNamaBankAttribute($value)
    {
        $this->attributes['nama_bank'] = $value ?? "-";
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function scopeIndex($query)
    {
        return $query->select('id', 'tgl_donasi', 'nama_donatur', 'alamat_donatur', 'nama_amil', 'nama_jenis_donasi', 'metode_donasi', 'nama_bank', 'nama_rekening', 'nominal', 'no_kwitansi', 'keterangan', 'created_at')->orderBy('tgl_donasi', 'desc')->orderBy('id', 'desc');
    }

    public function scopeIndexByDate($query, $date)
    {
        return $query->whereDate('tgl_donasi', $date)
                    ->select('id', 'tgl_donasi', 'nama_donatur', 'alamat_donatur', 'nama_amil', 'nama_jenis_donasi', 'metode_donasi', 'nama_bank', 'nama_rekening', 'nominal', 'no_kwitansi', 'keterangan', 'created_at')
                    ->orderBy('tgl_donasi', 'desc')->orderBy('id', 'desc');
    }

    public function scopeIndexByMonth($query, $month)
    {
        return $query->whereMonth('tgl_donasi', $month)
                    ->select('id', 'tgl_donasi', 'nama_donatur', 'alamat_donatur', 'nama_amil', 'nama_jenis_donasi', 'metode_donasi', 'nama_bank', 'nama_rekening', 'nominal', 'no_kwitansi', 'keterangan', 'created_at')
                    ->orderBy('tgl_donasi', 'desc')->orderBy('id', 'desc');
    }

    public function scopeCountByMonth($query, $value)
    {
        return $query->whereMonth('tgl_donasi', $value)->count();
    }

    public function scopeSumNominalByMonth($query, $value)
    {
        return $query->whereMonth('tgl_donasi', $value)->sum('nominal');
    }

    public function scopeSearch($query, $category, $keyword)
    {
        return $query->where(function($query) use ($category, $keyword) {
            $query->whereRaw('UPPER('.$category.') LIKE ?', ['%'.strtoupper($keyword).'%']);
        })->select('id', 'tgl_donasi', 'nama_donatur', 'alamat_donatur', 'nama_amil', 'nama_jenis_donasi', 'metode_donasi', 'nama_bank', 'nama_rekening', 'nominal', 'no_kwitansi', 'keterangan', 'created_at')->orderBy('tgl_donasi', 'desc')->orderBy('id', 'desc');
    }
}
