<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Helpers\DateFormatter;

class PengeluaranTahunanExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,  WithStyles
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
            DateFormatter::convertToIndonesianMonth($pengeluaran->bulan),
            $pengeluaran->jumlah_pengeluaran,
            number_format($pengeluaran->total_uang_keluar, 0, ".", ",")
        ];
    }

    public function headings(): array
    {
        return ["Bulan", "Jumlah Pengeluaran", "Nominal Pengeluaran"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
