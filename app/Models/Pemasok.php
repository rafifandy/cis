<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    
    protected $table = 'pemasok';
    protected $primaryKey = 'id_pemasok';
    protected $fillable = ['id_pemasok','nama_pemasok','alamat_pemasok','no_telp_pemasok','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class,'id_pemasok');
    }
}