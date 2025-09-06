<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaksi_id')
                  ->constrained('transaksii')
                  ->onDelete('cascade');

            $table->foreignId('produk_id')
                  ->constrained('produk')
                  ->onDelete('cascade');

            $table->integer('jumlah');
            $table->decimal('harga',15,2);     // harga per produk saat transaksi
            $table->decimal('subtotal',15,2);  // harga * jumlah

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
