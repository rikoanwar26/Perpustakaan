<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('kode_buku')->unique();
            $table->string('judul');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_penulis');
            $table->integer('harga');
            $table->integer('jumlah_stok');
            $table->boolean('tersedia_pinjam')->default(true);
            $table->boolean('tersedia_jual')->default(true);
            $table->string('penerbit')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

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

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
