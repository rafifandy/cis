<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penerimaan', function (Blueprint $table) {
            $table->bigInteger('id_penerimaan')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->primary(array('id_penerimaan','id_barang'));
            $table->foreign('id_penerimaan')->references('id_penerimaan')->on('penerimaan');
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
        Schema::dropIfExists('detail_penerimaan');
    }
}
