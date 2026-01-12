<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function index()
    {
        $penulis = Penulis::all();
        return view('petugas.penulis.index', compact('penulis'));
    }

    public function create()
    {
        return view('petugas.penulis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        Penulis::create($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan');
    }

    public function edit(Penulis $penulis)
    {
        return view('petugas.penulis.edit', compact('penulis'));
    }

    public function update(Request $request, Penulis $penulis)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        $penulis->update($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil diupdate');
    }

    public function destroy(Penulis $penulis)
    {
        $penulis->delete();

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil dihapus');
    }
}
