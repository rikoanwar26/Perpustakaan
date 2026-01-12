<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /* ===============================
        DASHBOARD
    =============================== */

    public function index()
    {
        $totalBuku        = Buku::count();
        $totalKategori    = Kategori::count();
        $totalPenulis     = Penulis::count();
        $totalTransaksi   = Transaksi::count();
        $transaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())->count();

        $transaksiTerbaru = Transaksi::with('pengguna')
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.index', compact(
            'totalBuku',
            'totalKategori',
            'totalPenulis',
            'totalTransaksi',
            'transaksiHariIni',
            'transaksiTerbaru'
        ));
    }

    /* ===============================
        DATA BUKU
    =============================== */

    public function buku()
    {
        return view('petugas.buku.index', [
            'buku' => Buku::with(['kategori', 'penulis'])->get(),
        ]);
    }

    public function tambahBuku()
    {
        return view('petugas.buku.tambah', [
            'kategori' => Kategori::all(),
            'penulis'  => Penulis::all(),
        ]);
    }

    public function simpanBuku(Request $request)
    {
        $request->validate([
            'judul'       => 'required',
            'id_kategori' => 'required',
            'id_penulis'  => 'required',
            'jumlah_stok' => 'required|numeric|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $namaFoto = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->storeAs('public/buku', $namaFoto);
        }

        Buku::create([
            'judul'       => $request->judul,
            'id_kategori' => $request->id_kategori,
            'id_penulis'  => $request->id_penulis,
            'jumlah_stok' => $request->jumlah_stok,
            'foto'        => $namaFoto,
        ]);

        return redirect('/petugas/buku')->with('success', 'Buku berhasil ditambahkan');
    }

    public function editBuku($id)
    {
        return view('petugas.buku.edit', [
            'buku'     => Buku::findOrFail($id),
            'kategori' => Kategori::all(),
            'penulis'  => Penulis::all(),
        ]);
    }

    public function updateBuku(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->validate([
            'judul'       => 'required',
            'id_kategori' => 'required',
            'id_penulis'  => 'required',
            'jumlah_stok' => 'required|numeric|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {

            if ($buku->foto && Storage::exists('public/buku/' . $buku->foto)) {
                Storage::delete('public/buku/' . $buku->foto);
            }

            $namaFoto = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->storeAs('public/buku', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $buku->update($data);

        return redirect('/petugas/buku')->with('success', 'Buku berhasil diperbarui');
    }

    public function hapusBuku($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto && Storage::exists('public/buku/' . $buku->foto)) {
            Storage::delete('public/buku/' . $buku->foto);
        }

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }

    /* ===============================
        TRANSAKSI
    =============================== */

    public function transaksi()
    {
        return view('petugas.transaksi.index', [
            'transaksi' => Transaksi::with(['pengguna', 'detail.buku'])
                ->latest()
                ->get(),
        ]);
    }

    public function konfirmasiPembayaran($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);

        if ($transaksi->jenis === 'jual') {
            foreach ($transaksi->detail as $d) {
                Buku::where('id_buku', $d->id_buku)
                    ->decrement('jumlah_stok', $d->jumlah);
            }
        }

        $transaksi->update([
            'status'  => 'Berhasil',
            'tanggal' => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi ✅');
    }

    public function hapusTransaksi($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);
        if ($transaksi->jenis === 'jual' && $transaksi->status === 'Berhasil') {
            foreach ($transaksi->detail as $d) {
                Buku::where('id_buku', $d->id_buku)->increment('jumlah_stok', $d->jumlah);
            }
        }
        $transaksi->detail()->delete();
        $transaksi->delete();
        return back()->with('success', 'Transaksi dihapus');
    }
}
