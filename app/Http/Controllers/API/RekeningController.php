<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Http\Requests\RekeningFormRequest;

class RekeningController extends Controller
{
    public function index()
    {
        return Rekening::select('id','nama','keterangan')->get()->toJson();
    }

    public function store(RekeningFormRequest $request)
    {
        Rekening::create($request->validated());

        return response()->json(['status' => 200, 'message' => 'Rekening berhasil ditambahkan']);
    }

    public function show(Rekening $rekening)
    {
        return $rekening->toJson();
    }

    public function update(RekeningFormRequest $request, Rekening $rekening)
    {
        $rekening->update($request->validated());

        return response()->json(['status' => 200, 'message' => 'Rekening berhasil diperbarui']);
    }

    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        return response()->json(['status' => 200, 'message' => 'Rekening berhasil dihapus']);
    }
}
