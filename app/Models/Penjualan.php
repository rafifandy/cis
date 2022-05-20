<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['id_penjualan','id_pelanggan','tgl_penjualan','total','keterangan','status','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function barang()
    {
        return $this->belongsToMany(Barang::class,'detail_penjualan','id_penjualan','id_barang')->withPivot('harga_barang','jumlah_barang','total_harga_barang');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'id_pelanggan');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class,'id_penjualan');
    }
}