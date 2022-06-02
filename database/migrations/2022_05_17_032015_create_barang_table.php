<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->bigInteger('id_kategori')->unsigned();
            $table->string('nama_barang',100);
            $table->bigInteger('harga_beli')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->integer('stok')->nullable();
            $table->string('keterangan',100)->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
