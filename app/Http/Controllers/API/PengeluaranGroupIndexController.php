<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;

class PengeluaranGroupIndexController extends Controller
{
    public function indexToday()
    {
        return Pengeluaran::indexToday()->get()->toJson();
    }

    public function indexByMonth($month)
    {
        return Pengeluaran::indexByMonth($month)->paginate(20)->toJson();
    }
}
