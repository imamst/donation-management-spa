<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_amil');
            $table->string('nama_amil', 50)->nullable();
            $table->dateTime('tgl_login')->nullable();
            $table->dateTime('tgl_logout')->nullable();

            $table->primary(['id_amil']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
}
