<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_barang','id_kategori','nama_barang','foto_barang','harga_beli','harga_jual','stok','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function kategori()
    {
        return $this->belongsTo(Kategori_barang::class,'id_kategori');
    }
    public function gambar_barang()
    {
        return $this->hasMany(Gambar_barang::class,'id_gambar');
    }
    public function penjualan()
    {
        return $this->belongsToMany(Penjualan::class,'detail_penjualan','id_barang','id_penjualan')->withPivot('harga_barang', 'jumlah_barang');
    }
    public function pengadaan()
    {
        return $this->belongsToMany(Pengadaan::class,'detail_pengadaan','id_barang','id_pengadaan');
    }
}