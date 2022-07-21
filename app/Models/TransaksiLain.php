<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLain extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lain';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_transaksi','tgl_transaksi','jenis_transaksi','total','keterangan','status','pemesanan','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;
}
