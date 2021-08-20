<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonasiBulananExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,  WithStyles
{
    protected $donasi;

    public function __construct($donasi)
    {
        $this->donasi = $donasi;
    }

    public function collection()
    {
        return $this->donasi;
    }

    public function map($donasi): array
    {
        return [
            $donasi->tanggal_batch,
            $donasi->jumlah_donasi,
            number_format($donasi->total_uang_masuk, 0, ".", ",")
        ];
    }

    public function headings(): array
    {
        return ["Tanggal", "Jumlah Donasi", "Nominal Donasi"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
