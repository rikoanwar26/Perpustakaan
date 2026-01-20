<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $q = trim($request->get('q', ''));
        $buku = Buku::with(['kategori', 'penulis'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('penerbit', 'like', "%{$q}%")
                        ->orWhereHas('kategori', function ($k) use ($q) {
                            $k->where('nama', 'like', "%{$q}%");
                        })
                        ->orWhereHas('penulis', function ($p) use ($q) {
                            $p->where('nama', 'like', "%{$q}%");
                        });
                });
            })
            ->get();
        return view('user.index', compact('buku'));
    }

    public function beli(Request $request)
    {
        $q = trim($request->get('q', ''));
        $buku = Buku::with(['kategori', 'penulis'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('penerbit', 'like', "%{$q}%")
                        ->orWhereHas('kategori', function ($k) use ($q) {
                            $k->where('nama', 'like', "%{$q}%");
                        })
                        ->orWhereHas('penulis', function ($p) use ($q) {
                            $p->where('nama', 'like', "%{$q}%");
                        });
                });
            })
            ->get();
        return view('user.beli', compact('buku'));
    }

    public function pinjam(Request $request)
    {
        $q = trim($request->get('q', ''));
        $buku = Buku::with(['kategori', 'penulis'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('penerbit', 'like', "%{$q}%")
                        ->orWhereHas('kategori', function ($k) use ($q) {
                            $k->where('nama', 'like', "%{$q}%");
                        })
                        ->orWhereHas('penulis', function ($p) use ($q) {
                            $p->where('nama', 'like', "%{$q}%");
                        });
                });
            })
            ->get();
        return view('user.pinjam', compact('buku'));
    }
}
