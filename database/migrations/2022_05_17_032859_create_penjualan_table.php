<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->bigInteger('id_pelanggan')->unsigned();
            $table->date('tgl_penjualan');
            $table->bigInteger('total')->nullable();
            $table->integer('tipe_potongan_pnj')->nullable();
            $table->float('potongan_penjualan_t1')->nullable();
            $table->bigInteger('potongan_penjualan_t2')->nullable();
            $table->bigInteger('total_akhir')->nullable();
            $table->string('keterangan',100)->nullable();
            $table->string('pemesanan',100)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
