<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_barang', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori',100);
            $table->string('keterangan',100)->nullable();
            $table->timestamp('timestamp');
        });
        $data = [
            ['nama_kategori'=>'Bahan Kue'],
            ['nama_kategori'=>'Bahan Makanan'],
            ['nama_kategori'=>'Bahan Minuman'],
            ['nama_kategori'=>'Alat-alat'],
            ['nama_kategori'=>'Lain-lain']
        ];
        DB::table('kategori_barang')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_barang');
    }
}
