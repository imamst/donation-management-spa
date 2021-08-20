<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_donasi');
            $table->unsignedInteger('id_donatur');
            $table->string('nama_donatur', 50);
            $table->text('alamat_donatur');
            $table->unsignedTinyInteger('id_amil');
            $table->string('nama_amil', 50);
            $table->unsignedTinyInteger('id_jenis_donasi');
            $table->string('nama_jenis_donasi', 100);
            $table->enum('metode_donasi', ['Tunai', 'Barang', 'Overbook']);
            $table->unsignedTinyInteger('id_rekening')->nullable();
            $table->string('nama_rekening', 50)->nullable();
            $table->unsignedInteger('nominal');
            $table->string('no_kwitansi', 25);
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
        Schema::dropIfExists('donasi');
    }
}
