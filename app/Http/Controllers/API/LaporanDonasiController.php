<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Models\Donasi;
use App\Exports\DonasiHarianExport;
use App\Exports\DonasiBulananExport;
use App\Exports\DonasiTahunanExport;
use App\Helpers\DateFormatter;

class LaporanDonasiController extends Controller
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
        $donasi = Donasi::indexByDate($tanggal)->get();

        if(\Request::get('jenis_donasi') != null) {
            $donasi = $donasi->where('nama_jenis_donasi', \Request::get('jenis_donasi'))->all();
        }

        return $donasi;
    }

    public function indexBulanan($bulan)
    {
        $tahun = date('Y');
        
        $donasi = DB::select("SELECT tanggal_batch, SUM(jumlah_donasi) AS jumlah_donasi, SUM(total_uang_masuk) AS total_uang_masuk, jenis_donasi 
                    FROM mv_daily_income 
                    WHERE EXTRACT(MONTH FROM tanggal_batch)='".$bulan."' AND EXTRACT(YEAR FROM tanggal_batch)='".$tahun."' 
                    GROUP BY jenis_donasi, tanggal_batch 
                    ORDER BY tanggal_batch");

        return $donasi;
    }

    public function indexTahunan($tahun)
    {
        $donasi = DB::select("SELECT EXTRACT(MONTH FROM tanggal_batch) AS bulan, SUM(jumlah_donasi) AS jumlah_donasi, SUM(total_uang_masuk) AS total_uang_masuk, jenis_donasi
                        FROM mv_daily_income 
                        WHERE EXTRACT(YEAR FROM tanggal_batch)='".$tahun."' 
                        GROUP BY jenis_donasi, EXTRACT(MONTH FROM tanggal_batch), EXTRACT(YEAR FROM tanggal_batch)
                        ORDER BY EXTRACT(YEAR FROM tanggal_batch), EXTRACT(MONTH FROM tanggal_batch)");

        return $donasi;
    }

    public function exportExcel()
    {
        if(\Request::get('tanggal')) {
            $donasi = $this->indexTanggal(\Request::get('tanggal'));

            return Excel::download(new DonasiHarianExport($donasi), 'Laporan Donasi '.\Request::get('tanggal').'.xlsx');
        }
        else if(\Request::get('bulan')) {
            $donasi = collect($this->indexBulanan(\Request::get('bulan')));
            $bulan = DateFormatter::convertToIndonesianMonth(\Request::get('bulan'));
            $tahun = date('Y');

            return Excel::download(new DonasiBulananExport($donasi), 'Laporan Donasi '.$bulan.' '.$tahun.'.xlsx');
        }
        else if(\Request::get('tahun')) {
            $donasi = collect($this->indexTahunan(\Request::get('tahun')));

            return Excel::download(new DonasiTahunanExport($donasi), 'Laporan Donasi '.\Request::get('tahun').'.xlsx');
        }
    }
}
