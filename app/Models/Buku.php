<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    public function getRouteKeyName()
    {
        return 'id_buku';
    }

    protected $fillable = [
        'kode_buku',
        'judul',
        'id_kategori',
        'id_penulis',
        'harga',
        'jumlah_stok',
        'tersedia_pinjam',
        'tersedia_jual',
        'foto',
        'penerbit',
    ];

    // RELASI KE KATEGORI
    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }

    // RELASI KE PENULIS
    public function penulis()
    {
        return $this->belongsTo(
            Penulis::class,
            'id_penulis',
            'id_penulis'
        );
    }
}
