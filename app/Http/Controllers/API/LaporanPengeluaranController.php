<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Models\Pengeluaran;
use App\Exports\PengeluaranHarianExport;
use App\Exports\PengeluaranBulananExport;
use App\Exports\PengeluaranTahunanExport;
use App\Helpers\DateFormatter;

class LaporanPengeluaranController extends Controller
{
    public function index()
    {
        if(\Request::get('tanggal')) {
            return json_encode($this->indexTanggal(\Request::get('tanggal')));
        }
        else if(\Request::get('bulan')) {
            return json_encode($this->indexBulanan(\Request::get('bulan')));
        }
        else if(\Request::get('tahun')) {
            return json_encode($this->indexTahunan(\Request::get('tahun')));
        }
    }

    public function indexTanggal($tanggal)
    {
        $pengeluaran = Pengeluaran::indexByDate($tanggal)->get();

        if(\Request::get('jenis_pengeluaran') != null) {
            $pengeluaran = $pengeluaran->where('nama_jenis_pengeluaran', \Request::get('jenis_pengeluaran'))->all();
        }

        return $pengeluaran;
    }

    public function indexBulanan($bulan)
    {
        $tahun = date('Y');

        $pengeluaran = DB::select("SELECT tanggal_batch, SUM(jumlah_pengeluaran) AS jumlah_pengeluaran, SUM(total_uang_keluar) AS total_uang_keluar, jenis_pengeluaran 
                        FROM mv_daily_outcome 
                        WHERE EXTRACT(MONTH FROM tanggal_batch)='".$bulan."' AND EXTRACT(YEAR FROM tanggal_batch)='".$tahun."' 
                        GROUP BY jenis_pengeluaran, tanggal_batch 
                        ORDER BY tanggal_batch");

        return $pengeluaran;
    }

    public function indexTahunan($tahun)
    {
        $pengeluaran = DB::select("SELECT EXTRACT(MONTH FROM tanggal_batch) AS bulan, SUM(jumlah_pengeluaran) AS jumlah_pengeluaran, SUM(total_uang_keluar) AS total_uang_keluar, jenis_pengeluaran
                        FROM mv_daily_outcome 
                        WHERE EXTRACT(YEAR FROM tanggal_batch)='".$tahun."' 
                        GROUP BY jenis_pengeluaran, EXTRACT(MONTH FROM tanggal_batch), EXTRACT(YEAR FROM tanggal_batch)
                        ORDER BY EXTRACT(YEAR FROM tanggal_batch), EXTRACT(MONTH FROM tanggal_batch)");

        return $pengeluaran;
    }

    public function exportExcel()
    {
        if(\Request::get('tanggal')) {
            $pengeluaran = $this->indexTanggal(\Request::get('tanggal'));

            return Excel::download(new PengeluaranHarianExport($pengeluaran), 'Laporan Pengeluaran '.\Request::get('tanggal').'.xlsx');
        }
        else if(\Request::get('bulan')) {
            $pengeluaran = collect($this->indexBulanan(\Request::get('bulan')));
            $bulan = DateFormatter::convertToIndonesianMonth(\Request::get('bulan'));
            $tahun = date('Y');

            return Excel::download(new PengeluaranBulananExport($pengeluaran), 'Laporan Pengeluaran '.$bulan.' '.$tahun.'.xlsx');
        }
        else if(\Request::get('tahun')) {
            $pengeluaran = collect($this->indexTahunan(\Request::get('tahun')));

            return Excel::download(new PengeluaranTahunanExport($pengeluaran), 'Laporan Pengeluaran '.\Request::get('tahun').'.xlsx');
        }
    }
}
