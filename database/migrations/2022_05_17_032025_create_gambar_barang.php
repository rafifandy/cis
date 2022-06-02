<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_barang', function (Blueprint $table) {
            $table->id('id_gambar');
            $table->bigInteger('id_barang')->unsigned();
            $table->string('foto_barang')->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gambar_barang');
    }
}
