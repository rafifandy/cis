<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->bigInteger('id_pengadaan')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->integer('jumlah_barang')->nullable();
            $table->bigInteger('harga_barang')->nullable();
            $table->bigInteger('total_harga_barang')->nullable();
            $table->primary(array('id_pengadaan','id_barang'));
            $table->foreign('id_pengadaan')->references('id_pengadaan')->on('pengadaan');
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
        Schema::dropIfExists('detail_pengadaan');
    }
}
