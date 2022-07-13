<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigInteger('id_pengiriman')->unsigned();
            $table->bigInteger('id_penjualan')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->primary(array('id_pengiriman','id_penjualan','id_barang'));
            $table->foreign('id_pengiriman')->references('id_pengiriman')->on('pengiriman');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('detail_penjualan');
            $table->foreign('id_barang')->references('id_barang')->on('detail_penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengiriman');
    }
}
