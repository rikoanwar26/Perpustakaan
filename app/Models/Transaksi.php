<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // pastikan ini sesuai nama tabel di database
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_pengguna',
        'jenis',
        'status',
        'tanggal',
        'jatuh_tempo',
        'metode_pengantaran',
        'biaya_pengantaran',
        'biaya_peminjaman'
    ];

    // Relasi ke detail transaksi
    // Relasi detail
public function detail()
{
    return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
}

// Relasi buku via detail
public function buku()
{
    return $this->hasManyThrough(
        Buku::class,
        DetailTransaksi::class,
        'id_transaksi', // FK di detail_transaksi
        'id_buku',      // FK di buku
        'id_transaksi', // PK di transaksi
        'id_buku'       // PK di detail_transaksi
    );
}

// Relasi pengembalian
public function pengembalian()
{
    return $this->hasOne(Pengembalian::class, 'id_transaksi', 'id_transaksi');
}

// Relasi pengguna
public function pengguna()
{
    return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
}
}
