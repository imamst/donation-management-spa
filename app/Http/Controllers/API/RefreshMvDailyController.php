<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RefreshMvDailyController extends Controller
{
    public function __invoke()
    {
        try {
            DB::statement("REFRESH MATERIALIZED VIEW mv_daily_income");
            DB::statement("REFRESH MATERIALIZED VIEW mv_daily_outcome");

            return response()->json(['status' => 200, 'success' => true, 'message' => 'Refresh MV berhasil']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 200, 'success' => false, 'message' => 'Refresh MV gagal']);
        }
    }
}
