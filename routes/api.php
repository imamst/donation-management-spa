<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\AmilController;
use App\Http\Controllers\API\NoKwitansiController;
use App\Http\Controllers\API\DonasiController;
use App\Http\Controllers\API\DonasiSearchController;
// use App\Http\Controllers\API\DonasiGroupIndexController;
use App\Http\Controllers\API\DonasiExportController;
use App\Http\Controllers\API\LaporanDonasiController;
use App\Http\Controllers\API\PengeluaranController;
use App\Http\Controllers\API\PengeluaranSearchController;
// use App\Http\Controllers\API\PengeluaranGroupIndexController;
use App\Http\Controllers\API\LaporanPengeluaranController;
use App\Http\Controllers\API\CashFlowController;
use App\Http\Controllers\API\LaporanNeracaController;
use App\Http\Controllers\API\RekeningController;
use App\Http\Controllers\API\DonaturController;
use App\Http\Controllers\API\JenisDonasiController;
use App\Http\Controllers\API\JenisPengeluaranController;
use App\Http\Controllers\API\MonitoringController;
use App\Http\Controllers\API\RefreshMvDailyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/cron/refresh/mv', [RefreshMvDailyController::class]);

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('/account/password', [AccountPasswordController::class, 'update']);

    Route::apiResource('/master/jenis-donasi', JenisDonasiController::class);
    Route::get('/master/jenis-pengeluaran', [JenisPengeluaranController::class, 'index']);

    Route::get('/rekening', [RekeningController::class, 'index']);
    Route::post('/rekening', [RekeningController::class, 'store']);
    Route::get('/rekening/{rekening}', [RekeningController::class, 'show']);

    Route::get('/donatur', [DonaturController::class, 'index']);
    Route::get('/donatur/paginate', [DonaturController::class, 'indexPaginate']);
    Route::post('/donatur', [DonaturController::class, 'store']);
    Route::get('/donatur/search', [DonaturController::class, 'search']);
    Route::get('/donatur/{donatur}', [DonaturController::class, 'show']);

    Route::get('/receipt/{jenis_transaksi}', [NoKwitansiController::class, 'get']);

    Route::get('/donasi/export/today', [DonasiExportController::class, 'exportExcelToday']);
    Route::get('transaksi/donasi/{donasi}/export', [DonasiExportController::class, 'cetakKwitansi']);
    Route::get('/transaksi/donasi', [DonasiController::class, 'index']);
    Route::get('/transaksi/donasi/status', [DonasiController::class, 'checkStatusTutupBuku']);
    Route::get('/transaksi/donasi/close', [DonasiController::class, 'tutupBuku']);
    Route::get('/transaksi/donasi/search', [DonasiSearchController::class, 'search']);
    Route::post('/transaksi/donasi', [DonasiController::class, 'store']);
    Route::get('/laporan/donasi', [LaporanDonasiController::class, 'index']);
    Route::get('/laporan/donasi/export', [LaporanDonasiController::class, 'exportExcel']);

    Route::middleware('amil.senior')->group(function() {
        Route::patch('/rekening/{rekening}', [RekeningController::class, 'update']);
        Route::patch('/donatur/{donatur}', [DonaturController::class, 'update']);
        Route::get('/transaksi/donasi/{donasi}', [DonasiController::class, 'show']);
        Route::get('/laporan/pengeluaran', [LaporanPengeluaranController::class, 'index']);
        Route::get('/laporan/pengeluaran/export', [LaporanPengeluaranController::class, 'exportExcel']);
        Route::get('/laporan/neraca', [LaporanNeracaController::class, 'index']);
        Route::get('/laporan/neraca/export', [LaporanNeracaController::class, 'exportExcel']);
    });

    Route::middleware('admin')->group(function() {

        Route::get('/donasi/count/month/{month}', [CashFlowController::class, 'countMonthDonation']);
        Route::get('/donasi/sum/month/{month}', [CashFlowController::class, 'getMonthDonationNominal']);

        Route::get('/pengeluaran/count/month/{month}', [CashFlowController::class, 'countMonthSpending']);
        Route::get('/pengeluaran/sum/month/{month}', [CashFlowController::class, 'getMonthSpendingNominal']);

        Route::get('/cash/balance/current-month', [CashFlowController::class, 'getCurrentMonthCashBalance']);

        Route::patch('/transaksi/donasi/{donasi}', [DonasiController::class, 'update']);
        Route::delete('/transaksi/donasi/{donasi}', [DonasiController::class, 'destroy']);

        Route::get('/transaksi/pengeluaran', [PengeluaranController::class, 'index']);
        Route::post('/transaksi/pengeluaran', [PengeluaranController::class, 'store']);
        Route::get('/transaksi/pengeluaran/search', [PengeluaranSearchController::class, 'search']);
        Route::get('/transaksi/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'show']);
        Route::patch('/transaksi/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update']);
        Route::delete('/transaksi/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'destroy']);
    });

    Route::middleware('superadmin')->group(function() {
        Route::get('/amil', [AmilController::class, 'index']);
        Route::post('/amil', [AmilController::class, 'store']);
        Route::delete('/amil/{amil}', [AmilController::class, 'destroy']);
        Route::patch('/amil/{amil}/block', [AmilController::class, 'block']);
        Route::patch('/amil/{amil}/unblock', [AmilController::class, 'unblock']);
        Route::apiResource('/master/jenis-pengeluaran', JenisPengeluaranController::class)->except(['index']);
        Route::delete('/rekening/{rekening}', [RekeningController::class, 'destroy']);
        Route::delete('/donatur/{donatur}', [DonaturController::class, 'destroy']);
        Route::get('/monitoring', [MonitoringController::class, 'index']);
    });
});
