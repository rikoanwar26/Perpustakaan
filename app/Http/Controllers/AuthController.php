<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // =====================
        // LOGIN PETUGAS (ADMIN)
        // =====================
        $petugas = Petugas::where('email', $request->email)->first();
        if ($petugas && Hash::check($request->password, $petugas->password)) {

            session([
                'login' => true,
                'id' => $petugas->id_petugas,
                'nama' => $petugas->nama,
                'role' => 'admin',
            ]);

            return redirect('/petugas');
        }

        // =====================
        // LOGIN PENGGUNA (USER)
        // =====================
        $pengguna = Pengguna::where('email', $request->email)->first();
        if ($pengguna && Hash::check($request->password, $pengguna->password)) {

            session([
                'login' => true,
                'id' => $pengguna->id_pengguna,
                'nama' => $pengguna->nama,
                'role' => 'user',
            ]);

            return redirect('/user');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}
