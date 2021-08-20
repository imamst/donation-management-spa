<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\DonasiTodayExport;
use App\Models\Donasi;
use App\Helpers\DateFormatter;

class DonasiExportController extends Controller
{
    public function cetakKwitansi(Donasi $donasi)
    {
        $customPaper = array(0,0,396.85,609.448);
        $tanggal = DateFormatter::indonesianDateFormat(date('d-m-Y'));

        $pdf = PDF::loadView('pdf.kwitansi-donasi', compact('donasi', 'tanggal'))->setPaper($customPaper, 'landscape');

        return $pdf->download('Kwitansi Donasi - '.$donasi->no_kwitansi.'.pdf');
    }

    public function exportExcelToday()
    {
        return Excel::download(new DonasiTodayExport, 'Rekap Donasi '.\Request::get("tanggal").'.xlsx');
    }
}
