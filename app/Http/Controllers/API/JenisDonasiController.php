<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisDonasiFormRequest;
use App\Models\JenisDonasi;

class JenisDonasiController extends Controller
{
    public function index()
    {
        return JenisDonasi::select('id','nama','minimum_donasi')->get()->toJson();
    }

    public function store(JenisDonasiFormRequest $request)
    {
        JenisDonasi::create($request->validated());

        return response()->json(['status' => 200, 'message' => 'Jenis Donasi berhasil ditambahkan']);
    }

    public function show(JenisDonasi $jenis_donasi)
    {
        return $jenis_donasi->toJson();
    }

    public function update(JenisDonasiFormRequest $request, JenisDonasi $jenis_donasi)
    {
        $jenis_donasi->update($request->validated());

        return response()->json(['status' => 200, 'message' => 'Jenis Donasi berhasil diperbarui']);
    }

    public function destroy(JenisDonasi $jenis_donasi)
    {
        $jenis_donasi->delete();

        return response()->json(['status' => 200, 'message' => 'Jenis Donasi berhasil dihapus']);
    }
}
