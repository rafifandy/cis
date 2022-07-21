<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_laporan','tgl_awal','tgl_akhir','keterangan','status','pemesanan','timestamp'];
    
    public $timestamps = false;
    public $incrementing = false;
}
