<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KepalaPerpusController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
// use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');

Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');

//Buku Controller
Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::put('/buku/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
});

Route::controller(KepalaPerpusController::class)->group(function () {
    Route::get('/kepala/buku', 'index')->name('kepala.buku.index');
    Route::get('/kepala/buku/create', 'create')->name('kepala.buku.create');
    Route::post('/kepala/buku', 'store')->name('kepala.buku.store');
    Route::get('/kepala/buku/{buku}/edit', 'edit')->name('kepala.buku.edit');
    Route::put('/kepala/buku/{buku}', 'update')->name('kepala.buku.update');
    Route::delete('/kepala/buku/{buku}', 'destroy')->name('kepala.buku.destroy');
});

//Controller kepala
Route::prefix('/kepala')->middleware(['auth', 'role:kepala_perpustakaan'])->group(function () {
    //Pengguna Controller
    Route::controller(PenggunaController::class)->group(function () {
        Route::get('/pengguna', 'index')->name('kepala.pengguna.index');
        Route::get('/pengguna/create', 'create')->name('kepala.pengguna.create');
        Route::post('/pengguna', 'store')->name('kepala.pengguna.store');
        Route::get('/pengguna/{pengguna}/edit', 'edit')->name('kepala.pengguna.edit');
        Route::put('/pengguna/{id}', 'update')->name('kepala.pengguna.update');
        Route::delete('/pengguna/{id}', 'delete_pengguna')->name('kepala.pengguna.destroy');
        Route::get('/pengguna/{user}/detail', 'detail_pengguna')->name('kepala.pengguna.detail');
    });

    Route::controller(PenggunaController::class)->group(function () {
        Route::get('/pengguna', 'index')->name('kepala.pengguna.index');
        Route::get('/pengguna/create', 'create')->name('kepala.pengguna.create');
        Route::post('/pengguna', 'store')->name('kepala.pengguna.store');
        Route::get('/pengguna/{pengguna}/edit', 'edit')->name('kepala.pengguna.edit');
        Route::put('/pengguna/{id}', 'update')->name('kepala.pengguna.update');
        Route::delete('/pengguna/{id}', 'delete_pengguna')->name('kepala.pengguna.destroy');
        Route::get('/pengguna/{user}/detail', 'detail_pengguna')->name('kepala.pengguna.detail');
    });
});

Route::get('/refund/{id}', [PembayaranController::class, 'formRefund'])->name('refund.form');
Route::post('/refund/{id}', [PembayaranController::class, 'prosesRefund'])->name('refund.proses');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'showPembayaran'])->name('pembayaran.show');
Route::post('/pembayaran/{id}', [PembayaranController::class, 'prosesPembayaran'])->name('pembayaran.proses');

Route::post('/peminjaman/{id}/proses', [PengembalianController::class, 'prosesPengembalian'])
    ->name('peminjaman.proses');


Route::get('/petugas/pengajuan-pengembalian', [AuthController::class, 'pengajuanPengembalian'])
    ->name('peminjaman.pengajuan');

Route::get('/petugas/{id}/pengembalian', [PengembalianController::class, 'formPengembalian'])
    ->name('peminjaman.pengembalian.form');

// 🔹 proses pengembalian
Route::post('/petugas/{id}/kembalikan', [PengembalianController::class, 'pengembalian'])
    ->name('peminjaman.kembalikan');

// 🔹 halaman pembayaran
Route::get('/petugas/{id}/pembayaran', [PembayaranController::class, 'formPembayaran']) //ada
    ->name('peminjaman.pembayaran.form');

// 🔹 proses pembayaran
Route::post('/{id}/bayar', [PembayaranController::class, 'bayarDenda']) //ada
    ->name('peminjaman.bayar');


Route::get('/ajukan-pengembalian', [AuthController::class, 'ajukanPengembalianPage'])
    ->name('peminjaman.ajukan.page');

Route::post('/{id}/ajukan', [AuthController::class, 'ajukanPengembalian'])
    ->name('peminjaman.ajukan');


//Auth Controllers
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'HalLogin')->name('login');
    Route::post('/login', 'login')->name('loginproses');

    Route::get('/register', 'HalRegister')->name('HalRegister');
    Route::post('/registerproses', 'register')->name('registerproses');

    // Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', [AuthController::class, 'buku'])->name('anggota.buku')->middleware('auth', 'role:anggota');
Route::get('/buku/{id}/detail', [AuthController::class, 'detailBuku'])->name('anggota.buku.detail')->middleware('auth', 'role:anggota');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::controller('users', 'UserController');

Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::view('/anggota/dashboard', 'anggota.dashboard');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::view('/petugas/dashboard', 'petugas.dashboard');
});

Route::middleware(['auth', 'role:kepala_perpustakaan'])->group(function () {
    Route::view('/kepala/dashboard', 'kepala.dashboard');
});

Route::post('/pinjam-buku', [PeminjamanBukuController::class, 'PeminjamanBuku'])
    ->name('pinjam.buku');
Route::post('/peminjaman/setujui/{id}', [PeminjamanBukuController::class, 'setujui'])->name('peminjaman.setujui');
Route::post('/peminjaman/tolak/{id}', [PeminjamanBukuController::class, 'tolak'])->name('peminjaman.tolak');


Route::get('/petugas/dashboard', [AuthController::class, 'petugasDashboard'])->name('petugasDashboard')->middleware('auth');

Route::get('/kepala/dashboard', [AuthController::class, 'kepalaDashboard'])->name('kepalaDashboard')->middleware('auth');


Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.anggota')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update.anggota')->middleware('auth');

Route::get('/profile/petugas', [ProfileController::class, 'profile_petugas'])->name('profile.petugas')->middleware('auth');
Route::post('/profile/update/petugas', [ProfileController::class, 'update_petugas'])->name('profile.update.petugas')->middleware('auth');

Route::get('/profile/kepala', [ProfileController::class, 'profile_kepala'])->name('profile.kepala')->middleware('auth');
Route::post('/profile/update/kepala', [ProfileController::class, 'update_kepala'])->name('profile.update.kepala')->middleware('auth');
