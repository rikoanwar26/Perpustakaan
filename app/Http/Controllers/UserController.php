<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class UserController extends Controller
{
    public function dashboard()
    {
        $buku = Buku::all();
        return view('user.index', compact('buku'));
    }

    public function beli()
    {
        $buku = Buku::all();
        return view('user.beli', compact('buku'));
    }

    public function pinjam()
    {
        $buku = Buku::all();
        return view('user.pinjam', compact('buku'));
    }
}
