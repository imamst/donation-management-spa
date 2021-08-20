<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\PengeluaranFormRequest;
use App\Models\Pengeluaran;
use App\Models\JenisPengeluaran;

class PengeluaranController extends Controller
{
    public function index()
    {
        return Pengeluaran::index()->paginate(20)->toJson();
    }

    public function store(PengeluaranFormRequest $request)
    {
        $data = $request->validated();

        $jenis_pengeluaran = JenisPengeluaran::findOrFail($data['id_jenis_pengeluaran']);
        $amil = Auth::user();

        Pengeluaran::create([
            'tgl_keluar' => $data['tgl_keluar'],
            'nama_penerima' => $data['nama_penerima'],
            'id_amil' => $amil->id,
            'nama_amil' => $amil->nama,
            'id_jenis_pengeluaran' => $jenis_pengeluaran->id,
            'nama_jenis_pengeluaran' => $jenis_pengeluaran->nama,
            'nominal' => $data['nominal'],
            'no_kwitansi' => $data['no_kwitansi'],
            'keterangan' => $data['keterangan']
        ]);

        return response()->json(['status' => 200, 'message' => 'Pengeluaran berhasil ditambahkan']);
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return $pengeluaran->toJson();
    }

    public function update(PengeluaranFormRequest $request, Pengeluaran $pengeluaran)
    {
        $data = $request->validated();
        
        $jenis_pengeluaran = JenisPengeluaran::findOrFail($data['id_jenis_pengeluaran']);
        $amil = Auth::user();

        $pengeluaran->update([
            'tgl_keluar' => $data['tgl_keluar'],
            'nama_penerima' => $data['nama_penerima'],
            'id_amil' => $amil->id,
            'nama_amil' => $amil->nama,
            'id_jenis_pengeluaran' => $jenis_pengeluaran->id,
            'nama_jenis_pengeluaran' => $jenis_pengeluaran->nama,
            'nominal' => $data['nominal'],
            'no_kwitansi' => $data['no_kwitansi'],
            'keterangan' => $data['keterangan']
        ]);

        return response()->json(['status' => 200, 'message' => 'Pengeluaran berhasil diperbarui']);
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return response()->json(['status' => 200, 'message' => 'Pengeluaran berhasil dihapus']);
    }
}
