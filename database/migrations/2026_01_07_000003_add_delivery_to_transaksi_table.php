<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('metode_pengantaran')->nullable()->after('status');
            $table->integer('biaya_pengantaran')->default(0)->after('metode_pengantaran');
            $table->integer('biaya_peminjaman')->nullable()->default(0)->after('biaya_pengantaran');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['metode_pengantaran', 'biaya_pengantaran', 'biaya_peminjaman']);
        });
    }
};
