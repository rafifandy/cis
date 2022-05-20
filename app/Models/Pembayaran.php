<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_pembayaran','id_penjualan','tgl_pembayaran','jumlah_bayar','keterangan','status','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class,'id_penjualan');
    }
}