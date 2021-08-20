<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Amil extends Authenticatable
{
    use HasFactory;

    protected $table = "amil";

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if(trim($value) === ''){
            return;
        }

        $this->attributes['password'] = Hash::make($value);
    }

    public function getRoleAttribute($value)
    {
        switch ($value) {
            case '1':
                return "Amil Junior";
            case '2':
                return "Amil Senior";
            case '3':
                return "Admin";
            case '4':
                return "Super Admin";
        }
    }

    public function getStatusAttribute($value)
    {
        return $value ? "Aktif" : "Non-Aktif";
    }

    public function scopeNotSuperAdmin($query)
    {
        return $query->where('role','<>',4)->select('id','nama','role','status','email')->orderBy('role')->orderBy('id');
    }
}
