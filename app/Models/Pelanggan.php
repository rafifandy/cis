<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['id_barang','nama_pelanggan','alamat_pelanggan','no_telp_pelanggan','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'id_pelanggan');
    }
}