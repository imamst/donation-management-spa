<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonasiTodayExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,  WithStyles
{
    public function collection()
    {
        return Donasi::indexByDate(date('Y-m-d'))->get();
    }

    public function map($donasi): array
    {
        return [
            $donasi->no_kwitansi,
            $donasi->nama_donatur,
            $donasi->alamat_donatur,
            $donasi->nama_jenis_donasi,
            $donasi->metode_donasi,
            $donasi->nama_bank,
            number_format($donasi->nominal, 0, ".", ","),
            $donasi->keterangan
        ];
    }

    public function headings(): array
    {
        return ["No. Kwitansi", "Nama Donatur", "Alamat", "Jenis", "Metode Donasi", "Nama Bank", "Nominal", "Keterangan"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
