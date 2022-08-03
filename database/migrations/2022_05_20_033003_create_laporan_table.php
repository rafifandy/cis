<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->string('keterangan',100)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('timestamp');
        });
        DB::table('laporan')->insert(
            array(
                'tgl_awal' => '2022-01-01',
                'tgl_akhir' => '2022-02-01'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
