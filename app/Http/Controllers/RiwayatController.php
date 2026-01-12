<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class RiwayatController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('detail.buku')
            ->where('id_pengguna', session('id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.riwayat', compact('transaksi'));
    }
}
