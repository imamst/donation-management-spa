<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonaturFormRequest;
use App\Models\Donatur;

class DonaturController extends Controller
{
    public function index()
    {
        return Donatur::index()->get()->toJson();
    }

    public function indexPaginate()
    {
        return Donatur::index()->paginate(20)->toJson();
    }

    public function store(DonaturFormRequest $request)
    {
        Donatur::create($request->validated());

        return response()->json(['status' => 200, 'message' => 'Donatur berhasil ditambahkan']);
    }

    public function show(Donatur $donatur)
    {
        return $donatur->toJson();
    }

    public function update(DonaturFormRequest $request, Donatur $donatur)
    {
        $donatur->update($request->validated());

        return response()->json(['status' => 200, 'message' => 'Donatur berhasil diperbarui']);
    }

    public function destroy(Donatur $donatur)
    {
        $donatur->delete();

        return response()->json(['status' => 200, 'message' => 'Donatur berhasil dihapus']);
    }

    public function search()
    {
        $keyword = \Request::get('q');

        $donaturs = ($keyword == '') ? Donatur::index()->paginate(20) : Donatur::searchByName($keyword)->paginate(20);

        return $donaturs->toJson();
    }
}
