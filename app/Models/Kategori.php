<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
     protected $table = 'kategori';


      protected $fillable = ['kategori'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buku(){
        return$this->hasMany(Kategori::class, 'kategori_id');
    }
}
