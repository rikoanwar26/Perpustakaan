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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail_transaksi');

            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_buku');

            $table->integer('jumlah');
            $table->integer('total_harga');

            $table->timestamps(); // ✅ WAJIB

            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksi')
                  ->cascadeOnDelete();

            $table->foreign('id_buku')
                  ->references('id_buku')
                  ->on('buku')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
