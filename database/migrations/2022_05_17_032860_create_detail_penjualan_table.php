<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigInteger('id_penjualan')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->bigInteger('harga_barang')->nullable();
            $table->integer('tipe_potongan_brg')->nullable();
            $table->float('potongan_barang_t1')->nullable();
            $table->bigInteger('potongan_barang_t2')->nullable();
            $table->bigInteger('total_harga_barang')->nullable();
            $table->bigInteger('total_harga_barang_akhir')->nullable();
            $table->integer('jumlah_terkirim')->nullable();
            $table->primary(array('id_penjualan','id_barang'));
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan');
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
        Schema::dropIfExists('detail_penjualan');
    }
}
