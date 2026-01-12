<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_penulis');
            $table->string('kode_buku');
            $table->integer('harga');
            $table->integer('jumlah_stok');
            $table->boolean('tersedia_pinjam');
            $table->boolean('tersedia_jual');
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->cascadeOnDelete();

            $table->foreign('id_penulis')
                  ->references('id_penulis')
                  ->on('penulis')
                  ->cascadeOnDelete();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
