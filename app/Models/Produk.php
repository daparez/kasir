<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // singular

    protected $fillable = [
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'satuan',
        'stok_awal',
        'stok_minimum',
        'kategori_id',
        'suplier_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id');
    }
}
