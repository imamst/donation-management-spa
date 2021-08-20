<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = "donatur";

    protected $guarded = [];

    public function scopeIndex($query)
    {
        return $query->select('id', 'nama', 'address', 'gender', 'email', 'phone', 'pekerjaan')->orderBy('id');
    }

    public function scopeSearchByName($query, $value)
    {
        return $query->where(function($query) use ($value) {
            $query->whereRaw('UPPER("nama") LIKE ?', ['%'.strtoupper($value).'%']);
        })->select('id', 'nama', 'address', 'gender', 'email', 'phone', 'pekerjaan')->orderBy('id');
    }
}
