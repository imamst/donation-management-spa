<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Pengeluaran;

class CashFlowController extends Controller
{
    public function countMonthDonation($month)
    {
        return Donasi::countByMonth($month);
    }

    public function getMonthDonationNominal($month)
    {
        return Donasi::sumNominalByMonth($month);
    }

    public function countMonthSpending($month)
    {
        return Pengeluaran::countByMonth($month);
    }

    public function getMonthSpendingNominal($month)
    {
        return Pengeluaran::sumNominalByMonth($month);
    }

    public function getCurrentMonthCashBalance()
    {
        return Donasi::sumNominalByMonth(date('m')) - Pengeluaran::sumNominalByMonth(date('m'));
    }
}
