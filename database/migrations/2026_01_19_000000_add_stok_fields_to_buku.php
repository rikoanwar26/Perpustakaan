<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            if (! Schema::hasColumn('buku', 'stok_pinjam')) {
                $table->integer('stok_pinjam')->default(0)->after('jumlah_stok');
            }
            if (! Schema::hasColumn('buku', 'stok_jual')) {
                $table->integer('stok_jual')->default(0)->after('stok_pinjam');
            }
        });
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            if (Schema::hasColumn('buku', 'stok_pinjam')) {
                $table->dropColumn('stok_pinjam');
            }
            if (Schema::hasColumn('buku', 'stok_jual')) {
                $table->dropColumn('stok_jual');
            }
        });
    }
};
