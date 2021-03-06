<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->bigInteger('id_pelanggan')->unsigned();
            $table->date('tgl_pemesanan');
            $table->bigInteger('total')->nullable();
            $table->bigInteger('total_akhir')->nullable();
            $table->string('keterangan',100)->nullable();
            $table->string('informasi',100)->nullable();
            $table->integer('status')->nullable();
            $table->string('informasi',100)->nullable();
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
        Schema::dropIfExists('pemesanan');
    }
}
