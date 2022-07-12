<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiLainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_lain', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tgl_transaksi');
            $table->integer('jenis_transaksi');
            $table->bigInteger('total');
            $table->string('keterangan',100)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_lain');
    }
}
