<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    
    
    protected $table="suplier";

        protected $fillable = [
        'nama_suplier',
        'kontak',
        'alamat',
    ];

    public function product()
{
    return $this->hasMany(Product::class);
}
}
