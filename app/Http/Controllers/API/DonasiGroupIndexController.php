<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donasi;

class DonasiGroupIndexController extends Controller
{
    public function indexToday()
    {
        return Donasi::indexToday()->get()->toJson();
    }

    public function indexByMonth($month)
    {
        return Donasi::indexByMonth($month)->paginate(20)->toJson();
    }
}
