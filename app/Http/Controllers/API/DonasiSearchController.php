<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donasi;

class DonasiSearchController extends Controller
{
    public function search()
    {
        $category = \Request::get('c');
        $keyword = \Request::get('q');

        $donasi_list = ($keyword == '') ? Donasi::index()->paginate(20) : Donasi::search($category, $keyword)->paginate(20);

        return $donasi_list->toJson();
    }
}
