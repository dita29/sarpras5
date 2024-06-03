<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'nama_produk', 'kode_produk', 'kategori_id', 'harga_produk', 'pinjam', 'qty', 'foto_produk'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    function stokin(){
        return $this->hasMany(StokIn::class);
    }

    function stokout(){
        return $this->hasMany(Pinjam::class);
    }
    public function pinjam() {
        return $this->hasMany(Pinjam::class);
    }
    public function tempat() {
        return $this->belongsTo(Tempat::class);
    }
}
