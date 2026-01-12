<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'prosesLogin']);

Route::get('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/register', [AuthController::class, 'processRegister'])
    ->name('register.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN / PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware('admin')->prefix('petugas')->group(function () {

    // Dashboard admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD
    Route::resource('buku', BukuController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penulis', PenulisController::class);

    // Daftar transaksi admin
    Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');

    // KONFIRMASI PEMBAYARAN
    // Wajib POST, tidak ada prefix 'petugas' lagi karena sudah di-group
    Route::post(
        '/transaksi/konfirmasi/{id}',
        [AdminController::class, 'konfirmasiPembayaran']
    )->name('admin.konfirmasi');    

    // HAPUS TRANSAKSI
    Route::delete('/transaksi/{id}', [AdminController::class, 'hapusTransaksi'])->name('admin.transaksi.hapus');
});

/*
|--------------------------------------------------------------------------
| USER / PENGGUNA
|--------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {

    // Dashboard user
    Route::get('/user', [UserController::class, 'dashboard'])
        ->name('user.dashboard');

    Route::get('/user/beli', [UserController::class, 'beli'])
        ->name('user.beli');

    Route::get('/user/pinjam', [UserController::class, 'pinjam'])
        ->name('user.pinjam');

    // Keranjang
    Route::get('/cart', [TransaksiController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [TransaksiController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [TransaksiController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [TransaksiController::class, 'checkoutCart'])->name('cart.checkout');

    // Checkout
    Route::post('/checkout', [TransaksiController::class, 'checkout']);

    // Halaman QRIS
    Route::get('/qris/{id}', [TransaksiController::class, 'qris'])->name('qris');

    // User klik "Saya sudah bayar"
    Route::post('/konfirmasi-bayar/{id}', [TransaksiController::class, 'ajukanKonfirmasi'])
        ->name('user.konfirmasi');

    // User batal bayar
    Route::post('/batal-bayar/{id}', [TransaksiController::class, 'batal'])
        ->name('user.batal');

    // Halaman sukses
    Route::get('/sukses/{id}', [TransaksiController::class, 'sukses'])->name('sukses');

    // Riwayat transaksi user
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
});
