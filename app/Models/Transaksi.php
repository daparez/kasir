<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table = 'transaksii';

    protected $fillable = ['total_harga'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
