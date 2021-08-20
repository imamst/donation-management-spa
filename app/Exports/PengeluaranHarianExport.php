<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengeluaranHarianExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,  WithStyles
{
    protected $pengeluaran;

    public function __construct($pengeluaran)
    {
        $this->pengeluaran = $pengeluaran;
    }

    public function collection()
    {
        return $this->pengeluaran;
    }

    public function map($pengeluaran): array
    {
        return [
            $pengeluaran->no_kwitansi,
            $pengeluaran->nama_penerima,
            $pengeluaran->nama_jenis_pengeluaran,
            number_format($pengeluaran->nominal, 0, ".", ","),
            $pengeluaran->created_at,
            $pengeluaran->keterangan
        ];
    }

    public function headings(): array
    {
        return ["No. Kwitansi", "Nama Penerima", "Jenis Pengeluaran", "Nominal", "Tanggal Dibuat", "Keterangan"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
