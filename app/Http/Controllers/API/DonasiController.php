<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Requests\DonasiFormRequest;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\Rekening;
use App\Models\JenisDonasi;

class DonasiController extends Controller
{
    public function index()
    {
        return Donasi::index()->paginate(20)->toJson();
    }

    public function store(DonasiFormRequest $request)
    {
        $data = $request->validated();
        $rekening = ["id" => null, "nama" => null];

        if(isset($data['id_rekening'])) {
            $rekening = Rekening::findOrFail($data['id_rekening'])->toArray();
        }

        $donatur = Donatur::findOrFail($data['id_donatur']);
        $jenis_donasi = JenisDonasi::findOrFail($data['id_jenis_donasi']);
        $amil = Auth::user();

        Donasi::create([
            'tgl_donasi' => $data['tgl_donasi'],
            'id_donatur' => $donatur->id,
            'nama_donatur' => $donatur->nama,
            'alamat_donatur' => $donatur->address,
            'id_amil' => $amil->id,
            'nama_amil' => $amil->nama,
            'id_jenis_donasi' => $jenis_donasi->id,
            'nama_jenis_donasi' => $jenis_donasi->nama,
            'metode_donasi' => $data['metode_donasi'],
            'nama_bank' => $data['nama_bank'],
            'id_rekening' => $rekening['id'],
            'nama_rekening' => $rekening['nama'],
            'nominal' => $data['nominal'],
            'no_kwitansi' => $data['no_kwitansi'],
            'keterangan' => $data['keterangan']
        ]);

        return response()->json(['status' => 200, 'message' => 'Donasi berhasil ditambahkan']);
    }

    public function show(Donasi $donasi)
    {
        return $donasi->toJson();
    }

    public function update(DonasiFormRequest $request, Donasi $donasi)
    {
        $data = $request->validated();
        $rekening = ["id" => null, "nama" => null];
        
        if(isset($data['id_rekening'])) {
            $rekening = Rekening::findOrFail($data['id_rekening'])->toArray();
        }

        $donatur = Donatur::findOrFail($data['id_donatur']);
        $jenis_donasi = JenisDonasi::findOrFail($data['id_jenis_donasi']);
        $amil = Auth::user();

        $donasi->update([
            'tgl_donasi' => $data['tgl_donasi'],
            'id_donatur' => $donatur->id,
            'nama_donatur' => $donatur->nama,
            'id_amil' => $amil->id,
            'nama_amil' => $amil->nama,
            'id_jenis_donasi' => $jenis_donasi->id,
            'nama_jenis_donasi' => $jenis_donasi->nama,
            'metode_donasi' => $data['metode_donasi'],
            'nama_bank' => $data['nama_bank'],
            'id_rekening' => $rekening['id'],
            'nama_rekening' => $rekening['nama'],
            'nominal' => $data['nominal'],
            'no_kwitansi' => $data['no_kwitansi'],
            'keterangan' => $data['keterangan']
        ]);

        return response()->json(['status' => 200, 'message' => 'Donasi berhasil diperbarui']);
    }

    public function destroy(Donasi $donasi)
    {
        $donasi->delete();

        return response()->json(['status' => 200, 'message' => 'Donasi berhasil dihapus']);
    }

    public function checkStatusTutupBuku()
    {
        $today = date('Y-m-d');

        $status = (Auth::user()->last_closed == $today) ? true : false;

        return response()->json(['status' => 200, 'result' => $status]);
    }

    public function tutupBuku()
    {
        DB::statement("REFRESH MATERIALIZED VIEW mv_daily_income");

        $amil = Auth::user();

        $amil->update(['last_closed' => date('Y-m-d')]);

        return response()->json(['status' => 200, 'message' => 'Tutup buku donasi berhasil']);
    }
}
