<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumberHolder extends Model
{
    use HasFactory;

    protected $table = 'serial_number_holder';
    protected $fillable = ['serial'];
    public $timestamps = FALSE;
}
