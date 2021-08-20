<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMvDailyIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE MATERIALIZED VIEW mv_daily_income AS 
            SELECT 
                DATE(tgl_donasi) AS tanggal_batch, 
                COUNT(id) AS jumlah_donasi, 
                SUM(nominal) AS total_uang_masuk,
                nama_jenis_donasi AS jenis_donasi
            FROM donasi 
            GROUP BY jenis_donasi, tanggal_batch 
            ORDER BY tanggal_batch");
        
        DB::statement("CREATE UNIQUE INDEX mv_daily_income_jenis_donasi_tgl_batch 
            ON mv_daily_income(jenis_donasi, tanggal_batch)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP MATERIALIZED VIEW mv_daily_income");
    }
}
