<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->bigInteger('id_penjualan')->unsigned();
            $table->date('tgl_pembayaran');
            $table->bigInteger('jumlah_bayar')->nullable();
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
        Schema::dropIfExists('pembayaran');
    }
}
