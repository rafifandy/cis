<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_pengadaan', function (Blueprint $table) {
            $table->id('id_berkas');
            $table->bigInteger('id_pengadaan')->unsigned();
            $table->string('foto_berkas')->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_pengadaan')->references('id_pengadaan')->on('pengadaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_pengadaan');
    }
}
