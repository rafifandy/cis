<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar_barang extends Model
{
    use HasFactory;

    protected $table = 'gambar_barang';
    protected $primaryKey = 'id_gambar';
    protected $fillable = ['id_gambar','id_barang','foto_barang'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_barang');
    }
}
