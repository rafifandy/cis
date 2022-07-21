<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';
    protected $fillable = ['id_pengiriman','id_penjualan','tgl_pengiriman','alamat_tujuan','keterangan','status','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class,'id_penjualan');
    }
}
