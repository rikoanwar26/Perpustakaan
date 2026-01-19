<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengembalian;
use App\Models\Buku;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $transaksiPinjam = Transaksi::where('jenis', 'pinjam')
            ->whereIn('status', ['Berhasil', 'Dikembalikan'])
            ->with('detail.buku', 'pengguna', 'pengembalian')
            ->get();

        return view('petugas.pengembalian.index', compact('transaksiPinjam'));
    }

    // Form tambah pengembalian manual
    public function create($id_transaksi)
    {
        $transaksi = Transaksi::with('detail.buku', 'pengguna')
            ->findOrFail($id_transaksi);

        return view('petugas.pengembalian.create', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'tanggal_kembali' => 'required|date',
            'kondisi_buku' => 'required|string',
            'denda' => 'required|numeric|min:0',
        ]);

        Pengembalian::create([
            'id_transaksi' => $request->id_transaksi,
            'tanggal_kembali' => $request->tanggal_kembali,
            'denda' => $request->denda,
            'kondisi_buku' => $request->kondisi_buku,
        ]);

        $transaksi = Transaksi::find($request->id_transaksi);
        if ($transaksi) {
            $transaksi->status = 'Dikembalikan';
            $transaksi->save();
        }

        $pesan = 'Pengembalian berhasil ditambahkan. Kondisi: ' .
            ucfirst($request->kondisi_buku) .
            ', Total denda: Rp ' .
            number_format($request->denda, 0, ',', '.');

        return redirect()->route('admin.pengembalian')->with('success', $pesan);
    }
}
