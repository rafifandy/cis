<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigInteger('id_pemesanan')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->bigInteger('harga_barang')->nullable();
            $table->bigInteger('total_harga_barang')->nullable();
            $table->primary(array('id_pemesanan','id_barang'));
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan');
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
        Schema::dropIfExists('detail_pemesanan');
    }
}
