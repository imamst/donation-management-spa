<?php

namespace App\Helpers;

class DateFormatter
{
    public static function convertToIndonesianMonth($numeric_month)
    {
        $month = '';

        switch ($numeric_month) {
            case 1:
                $month = 'Januari';
                break;
            
            case 2:
                $month = 'Februari';
                break;
            
            case 3:
                $month = 'Maret';
                break;
            
            case 4:
                $month = 'April';
                break;
            
            case 5:
                $month = 'Mei';
                break;
            
            case 6:
                $month = 'Juni';
                break;
            
            case 7:
                $month = 'Juli';
                break;
            
            case 8:
                $month = 'Agustus';
                break;
            
            case 9:
                $month = 'September';
                break;
            
            case 10:
                $month = 'Oktober';
                break;
            
            case 11:
                $month = 'November';
                break;
            
            case 12:
                $month = 'Desember';
                    break;
        }

        return $month;
    }

    public static function indonesianDateFormat($date_format_dmy)
    {
        $date = explode('-', $date_format_dmy);
        $tanggal = $date[0];
        $bulan = self::convertToIndonesianMonth($date[1]);
        $tahun = $date[2];

        return $tanggal.' '.$bulan.' '.$tahun;
    }
}