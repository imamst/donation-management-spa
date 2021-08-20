<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\SerialNumberHolder;

class NoKwitansiController extends Controller
{
    public function get($jenis_transaksi)
    {
        $serial = tap(SerialNumberHolder::where('nama',$jenis_transaksi)->first())->update([
                                                                'serial' => DB::raw('serial+1')
                                                            ])->fresh();

        $no_kwitansi = sprintf('%05d', $serial->serial);

        return response()->json(['status' => 200, 'no_kwitansi' => $no_kwitansi]);
    }
}
