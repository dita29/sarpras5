<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 'qty', 'pemohon', 'keterangan'
    ];

    function produk() {
        return $this->belongsTo(Produk::class);
    }

    // function satuan() {
    //     return $this->belongsTo(Satuan::class);
    // }

    // function tempat() {
    //     return $this->belongsTo(Tempat::class);
    // }
}
