<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id('id_pengadaan');
            $table->bigInteger('id_pemasok')->unsigned();
            $table->date('tgl_pengadaan');
            $table->bigInteger('total')->nullable();
            $table->string('keterangan',100)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('timestamp');
            $table->foreign('id_pemasok')->references('id_pemasok')->on('pemasok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan');
    }
}
