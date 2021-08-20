<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amil', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama', 50);
            $table->enum('role', [1,2,3,4]);
            $table->boolean('status')->default(true);
            $table->string('email', 50);
            $table->string('password', 60);
            $table->rememberToken();
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
        Schema::dropIfExists('amil');
    }
}
