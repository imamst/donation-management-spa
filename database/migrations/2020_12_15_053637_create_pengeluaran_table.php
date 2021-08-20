<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_penerima', 100);
            $table->unsignedTinyInteger('id_jenis_pengeluaran');
            $table->string('nama_jenis_pengeluaran', 100);
            $table->dateTime('tgl_keluar')->useCurrent();
            $table->unsignedInteger('nominal');
            $table->string('no_kwitansi', 25);
            $table->unsignedTinyInteger('id_amil');
            $table->string('nama_amil', 50);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
}
