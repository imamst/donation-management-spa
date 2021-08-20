<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Exports\NeracaBulananExport;
use App\Exports\NeracaTahunanExport;
use App\Helpers\DateFormatter;

class LaporanNeracaController extends Controller
{
    public function index()
    {
        if(\Request::get('bulan')) {
            return json_encode($this->indexBulanan(\Request::get('bulan')));
        }
        else if(\Request::get('tahun')) {
            return json_encode($this->indexTahunan(\Request::get('tahun')));
        }
    }

    public function indexBulanan($bulan)
    {
        $tahun = date('Y');

        $pengeluaran = DB::select(
                        "SELECT 
                            income.tanggal_batch, 
                            SUM(income.total_uang_masuk) AS total_uang_masuk, 
                            SUM(outcome.total_uang_keluar) AS total_uang_keluar 
                        FROM mv_daily_income AS income
                        LEFT OUTER JOIN mv_daily_outcome AS outcome ON income.tanggal_batch=outcome.tanggal_batch
                        WHERE 
                            EXTRACT(MONTH FROM income.tanggal_batch)='".$bulan."' 
                            AND EXTRACT(YEAR FROM income.tanggal_batch)='".$tahun."' 
                        GROUP BY income.tanggal_batch 
                        ORDER BY income.tanggal_batch");

        return $pengeluaran;
    }

    public function indexTahunan($tahun)
    {
        $pengeluaran = DB::select(
                        "SELECT 
                            EXTRACT(MONTH FROM income.tanggal_batch) AS bulan, 
                            SUM(income.total_uang_masuk) AS total_uang_masuk, 
                            SUM(outcome.total_uang_keluar) AS total_uang_keluar 
                        FROM mv_daily_income AS income
                        LEFT OUTER JOIN mv_daily_outcome AS outcome ON income.tanggal_batch=outcome.tanggal_batch
                        WHERE 
                            EXTRACT(YEAR FROM income.tanggal_batch)='".$tahun."' 
                        GROUP BY EXTRACT(MONTH FROM income.tanggal_batch), EXTRACT(YEAR FROM income.tanggal_batch)
                        ORDER BY EXTRACT(YEAR FROM income.tanggal_batch), EXTRACT(MONTH FROM income.tanggal_batch)");

        return $pengeluaran;
    }

    public function exportExcel()
    {
        if(\Request::get('bulan')) {
            $neraca = collect($this->indexBulanan(\Request::get('bulan')));
            $bulan = DateFormatter::convertToIndonesianMonth(\Request::get('bulan'));
            $tahun = date('Y');

            return Excel::download(new NeracaBulananExport($neraca), 'Laporan Neraca '.$bulan.' '.$tahun.'.xlsx');
        }
        else if(\Request::get('tahun')) {
            $neraca = collect($this->indexTahunan(\Request::get('tahun')));

            return Excel::download(new NeracaTahunanExport($neraca), 'Laporan Neraca '.\Request::get('tahun').'.xlsx');
        }
    }
}
