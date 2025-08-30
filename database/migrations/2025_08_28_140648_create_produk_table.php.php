<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->decimal('harga_beli', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->string('satuan')->nullable();
            $table->integer('stok_awal');
            $table->integer('stok_minimum');
            
            // relasi ke kategori
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')
                  ->references('id')->on('kategori')
                  ->onDelete('cascade');

            // relasi ke suplier
            $table->unsignedBigInteger('suplier_id');
            $table->foreign('suplier_id')
                  ->references('id')->on('suplier')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};