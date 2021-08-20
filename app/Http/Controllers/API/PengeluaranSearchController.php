<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;

class PengeluaranSearchController extends Controller
{
    public function search()
    {
        $category = \Request::get('c');
        $keyword = \Request::get('q');

        $pengeluaran_list = ($keyword == '') ? Pengeluaran::index()->paginate(20) : Pengeluaran::search($category, $keyword)->paginate(20);

        return $pengeluaran_list->toJson();
    }
}
