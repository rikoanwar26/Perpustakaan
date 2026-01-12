<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN / PETUGAS
    |--------------------------------------------------------------------------
    */

    // ADMIN - LIST BUKU
    public function index()
    {
        $buku = Buku::with(['kategori', 'penulis'])->get();

        return view('petugas.buku.index', compact('buku'));
    }

    // ADMIN - FORM TAMBAH
    public function create()
    {
        return view('petugas.buku.create', [
            'kategori' => Kategori::all(),
            'penulis' => Penulis::all(),
        ]);
    }

    // ADMIN - SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_penulis' => 'required|exists:penulis,id_penulis',
            'harga' => 'required|numeric|min:0',
            'jumlah_stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tersedia_pinjam' => 'sometimes|boolean',
            'tersedia_jual' => 'sometimes|boolean',
            'penerbit' => 'nullable|string|max:255',
        ]);

        Buku::create([
            'kode_buku' => 'BK-'.strtoupper(uniqid()),
            'judul' => $request->judul,
            'id_kategori' => $request->id_kategori,
            'id_penulis' => $request->id_penulis,
            'harga' => $request->harga,
            'jumlah_stok' => $request->jumlah_stok,
            'tersedia_pinjam' => $request->boolean('tersedia_pinjam'),
            'tersedia_jual' => $request->boolean('tersedia_jual'),
            'penerbit' => $request->penerbit,
            'foto' => $request->file('foto')
                ? $request->file('foto')->store('buku', 'public')
                : null,
        ]);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    // ADMIN - FORM EDIT
    public function edit(Buku $buku)
    {
        return view('petugas.buku.edit', [
            'buku' => $buku,
            'kategori' => Kategori::all(),
            'penulis' => Penulis::all(),
        ]);
    }

    // ADMIN - UPDATE
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'jumlah_stok' => 'required|integer|min:0',
            'foto' => 'nullable|image',
            'tersedia_pinjam' => 'sometimes|boolean',
            'tersedia_jual' => 'sometimes|boolean',
            'penerbit' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'judul',
            'id_kategori',
            'id_penulis',
            'jumlah_stok',
            'penerbit',
        ]);

        $data['tersedia_pinjam'] = $request->boolean('tersedia_pinjam');
        $data['tersedia_jual'] = $request->boolean('tersedia_jual');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    // ADMIN - HAPUS
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | USER / PENGGUNA
    |--------------------------------------------------------------------------
    */

    // USER - HANYA LIHAT BUKU (TANPA CRUD)
    public function userIndex()
    {
        $buku = Buku::with(['kategori', 'penulis'])->get();

        return view('user.index', compact('buku'));
    }
}
