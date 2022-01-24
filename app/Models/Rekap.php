<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;
    
    protected $table = 'rekap';
    protected $primaryKey = 'id_rekap';
    protected $fillable = ['id_rekap','nama_rekap','tgl_awal','tgl_akhir','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

}