<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_barang','nama_barang','foto_barang','harga_sementara','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function penjualan()
    {
        return $this->belongsToMany(Penjualan::class,'detail_penjualan','id_barang','id_penjualan')->withPivot('harga_barang', 'jumlah_barang');
    }
    public function pengadaan()
    {
        return $this->belongsToMany(Pengadaan::class,'detail_pengadaan','id_barang','id_pengadaan');
    }
}