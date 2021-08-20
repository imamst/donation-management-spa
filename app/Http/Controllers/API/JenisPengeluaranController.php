<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisPengeluaranFormRequest;
use App\Models\JenisPengeluaran;

class JenisPengeluaranController extends Controller
{
    public function index()
    {
        return JenisPengeluaran::select('id','nama','keterangan')->get()->toJson();
    }

    public function store(JenisPengeluaranFormRequest $request)
    {
        JenisPengeluaran::create($request->validated());

        return response()->json(['status' => 200, 'message' => 'Jenis Pengeluaran berhasil ditambahkan']);
    }

    public function show(JenisPengeluaran $jenis_pengeluaran)
    {
        return $jenis_pengeluaran->toJson();
    }

    public function update(JenisPengeluaranFormRequest $request, JenisPengeluaran $jenis_pengeluaran)
    {
        $jenis_pengeluaran->update($request->validated());

        return response()->json(['status' => 200, 'message' => 'Jenis Pengeluaran berhasil diperbarui']);
    }

    public function destroy(JenisPengeluaran $jenis_pengeluaran)
    {
        $jenis_pengeluaran->delete();

        return response()->json(['status' => 200, 'message' => 'Jenis Pengeluaran berhasil dihapus']);
    }
}
