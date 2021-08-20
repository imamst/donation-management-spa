<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMvDailyOutcome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE MATERIALIZED VIEW mv_daily_outcome AS 
            SELECT 
                DATE(tgl_keluar) AS tanggal_batch,
                COUNT(id) AS jumlah_pengeluaran,
                SUM(nominal) AS total_uang_keluar,
                nama_jenis_pengeluaran AS jenis_pengeluaran
            FROM pengeluaran 
            GROUP BY jenis_pengeluaran, tanggal_batch 
            ORDER BY tanggal_batch");
        
        DB::statement("CREATE UNIQUE INDEX mv_daily_outcome_jenis_pengeluaran_tanggal_batch 
            ON mv_daily_outcome(jenis_pengeluaran, tanggal_batch)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP MATERIALIZED VIEW mv_daily_outcome");
    }
}
