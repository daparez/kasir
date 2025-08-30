<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $table = "transaksii";
    protected $fillable = ['produk_id', 'jumlah', 'total'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    
}
