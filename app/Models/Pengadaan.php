<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;
    
    protected $table = 'pengadaan';
    protected $primaryKey = 'id_pengadaan';
    protected $fillable = ['id_pengadaan','id_pemasok','tgl_pengadaan','total','keterangan','status','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function barang()
    {
        return $this->belongsToMany(Barang::class,'detail_pengadaan','id_pengadaan','id_barang')->withPivot('harga_barang','jumlah_barang','total_harga_barang');
    }
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class,'id_pemasok');
    }
}