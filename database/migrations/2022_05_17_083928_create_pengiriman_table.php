<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->bigInteger('id_penjualan')->unsigned();
            $table->date('tgl_pengiriman');
            $table->string('alamat_tujuan');
            $table->string('keterangan',100)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengiriman');
    }
}
