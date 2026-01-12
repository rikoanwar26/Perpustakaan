<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon; // ✅ WAJIB
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    protected function getCart()
    {
        return session('cart', ['jual' => [], 'pinjam' => []]);
    }

    protected function saveCart($cart)
    {
        session(['cart' => $cart]);
    }

    public function checkout(Request $request)
{
    $request->validate([
        'id_buku' => 'required|exists:buku,id_buku',
        'jenis'   => 'required|in:jual,pinjam',
        'metode_pengantaran' => 'nullable|string|in:outlet,antar',
        'biaya_pengantaran' => 'nullable|integer|min:0',
        'biaya_peminjaman' => 'nullable|integer|min:0',
    ]);

    $buku = Buku::findOrFail($request->id_buku);

    // CEK STOK JIKA BELI
    if ($request->jenis === 'jual' && $buku->jumlah_stok < 1) {
        return back()->with('error', 'Stok buku habis ❌');
    }

    // SIMPAN TRANSAKSI
    $transaksi = Transaksi::create([
        'id_pengguna' => Session::get('id'),
        'jenis'       => $request->jenis,
        'tanggal'     => now(),
        'status'      => 'Menunggu Pembayaran',
        'metode_pengantaran' => $request->get('metode_pengantaran', 'outlet'),
        'biaya_pengantaran' => (int) $request->get('biaya_pengantaran', 0),
        'biaya_peminjaman' => $request->jenis === 'pinjam' ? (int) $request->get('biaya_peminjaman', 0) : 0,
    ]);

    // HITUNG TOTAL
    $jumlah = 1;
    $totalHarga = $buku->harga * $jumlah;

    // SIMPAN DETAIL TRANSAKSI
    DetailTransaksi::create([
        'id_transaksi' => $transaksi->id_transaksi,
        'id_buku'      => $buku->id_buku,
        'jumlah'       => $jumlah,
        'total_harga'  => $totalHarga,
    ]);

    // Pengurangan stok diproses saat konfirmasi admin
        return redirect('/qris/'.$transaksi->id_transaksi);
    }

    public function cart()
    {
        $cart = $this->getCart();
        $jualItems = Buku::whereIn('id_buku', array_keys($cart['jual']))->get();
        $pinjamItems = Buku::whereIn('id_buku', array_keys($cart['pinjam']))->get();
        return view('user.cart', compact('cart', 'jualItems', 'pinjamItems'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'jenis' => 'required|in:jual,pinjam',
        ]);
        $cart = $this->getCart();
        $id = (int) $request->id_buku;
        $jenis = $request->jenis;
        $cart[$jenis][$id] = ($cart[$jenis][$id] ?? 0) + 1;
        $this->saveCart($cart);
        return back()->with('success', 'Ditambahkan ke keranjang');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|integer',
            'jenis' => 'required|in:jual,pinjam',
        ]);
        $cart = $this->getCart();
        unset($cart[$request->jenis][(int)$request->id_buku]);
        $this->saveCart($cart);
        return back()->with('success', 'Dihapus dari keranjang');
    }

    public function checkoutCart(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:jual,pinjam',
            'metode_pengantaran' => 'nullable|string|in:outlet,antar',
            'biaya_pengantaran' => 'nullable|integer|min:0',
        ]);
        $cart = $this->getCart();
        $jenis = $request->jenis;
        $ids = array_keys($cart[$jenis]);
        if (empty($ids)) {
            return back()->with('error', 'Keranjang kosong');
        }
        $items = Buku::whereIn('id_buku', $ids)->get()->keyBy('id_buku');

        // Validasi stok untuk jual
        if ($jenis === 'jual') {
            foreach ($ids as $id) {
                if (($items[$id]->jumlah_stok ?? 0) < ($cart['jual'][$id] ?? 1)) {
                    return back()->with('error', 'Stok tidak cukup untuk beberapa buku');
                }
            }
        }

        $transaksi = Transaksi::create([
            'id_pengguna' => Session::get('id'),
            'jenis' => $jenis,
            'tanggal' => now(),
            'jatuh_tempo' => $jenis === 'pinjam' ? now()->addDays(5) : null,
            'status' => 'Menunggu Pembayaran',
            'metode_pengantaran' => $request->get('metode_pengantaran', 'outlet'),
            'biaya_pengantaran' => (int)$request->get('biaya_pengantaran', 0),
            'biaya_peminjaman' => $jenis === 'pinjam' ? array_sum($cart['pinjam']) * 10000 : 0,
        ]);

        foreach ($ids as $id) {
            $qty = $cart[$jenis][$id];
            $harga = $jenis === 'jual' ? (int)$items[$id]->harga : 10000;
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_buku' => $id,
                'jumlah' => $qty,
                'total_harga' => $harga * $qty,
            ]);
        }

        // Kosongkan keranjang jenis ini
        $cart[$jenis] = [];
        $this->saveCart($cart);

        return redirect('/qris/'.$transaksi->id_transaksi);
    }

    public function qris($id)
    {
        $transaksi = Transaksi::with('detail.buku')->findOrFail($id);
        $totalDetail = $transaksi->detail->sum('total_harga');
        $total = $totalDetail + (int)$transaksi->biaya_pengantaran + (int)$transaksi->biaya_peminjaman;
        return view('user.qris', [
            'id' => $id,
            'jenis' => $transaksi->jenis,
            'total' => $total,
        ]);
    }

    public function batal($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);
        // Jika sebelumnya stok sudah dikurangi di proses lama, kembalikan untuk jenis jual
        if ($transaksi->jenis === 'jual') {
            foreach ($transaksi->detail as $d) {
                Buku::where('id_buku', $d->id_buku)->increment('jumlah_stok', $d->jumlah);
            }
        }
        $transaksi->update(['status' => 'Dibatalkan']);
        return redirect('/riwayat')->with('success', 'Pembayaran dibatalkan ❌');
    }
    public function sukses($id)
    {
        Transaksi::where('id_transaksi', $id)
            ->update(['status' => 'Berhasil']);

        return redirect('/riwayat')
            ->with('success', 'Pembayaran berhasil ✅');
    }

    public function ajukanKonfirmasi($id)
    {
        Transaksi::where('id_transaksi', $id)->update([
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect('/riwayat')->with(
            'success',
            'Pembayaran dikirim. Menunggu konfirmasi petugas ⏳'
        );
    }
}
