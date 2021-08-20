<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Helpers\DateFormatter;

class NeracaTahunanExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,  WithStyles
{
    protected $neraca;

    public function __construct($neraca)
    {
        $this->neraca = $neraca;
    }

    public function collection()
    {
        return $this->neraca;
    }

    public function map($neraca): array
    {
        return [
            DateFormatter::convertToIndonesianMonth($neraca->bulan),
            number_format($neraca->total_uang_masuk, 0, ".", ","),
            number_format($neraca->total_uang_keluar, 0, ".", ","),
            number_format(($neraca->total_uang_masuk - $neraca->total_uang_keluar), 0, ".", ",")
        ];
    }

    public function headings(): array
    {
        return ["Bulan", "Nominal Donasi", "Nominal Pengeluaran", "Saldo"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
