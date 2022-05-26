<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->string('alamat_pelanggan')->nullable();
            $table->string('no_telp_pelanggan')->nullable();
            $table->string('keterangan',100)->nullable();
            $table->timestamp('timestamp');
        });
        DB::table('pelanggan')->insert(
            array(
                'nama_pelanggan' => '(public)',
                'keterangan' => 'pelanggan umum'
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
        Schema::dropIfExists('pelanggan');
    }
}
