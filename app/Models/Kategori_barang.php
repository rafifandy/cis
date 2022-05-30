<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_barang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['id_kategori','nama_kategori','keterangan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function barang()
    {
        return $this->hasMany(Penjualan::class,'id_kategori');
    }
}
