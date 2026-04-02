<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KepalaPerpusController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
    
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
    Route::put('/kepala/buku/{buku}','update')->name('kepala.buku.update');
    Route::delete('/kepala/buku/{buku}', 'destroy')->name('kepala.buku.destroy');
});

//Pengguna Controller
Route::controller(PenggunaController::class)->group(function () {
    Route::get('/kepala/pengguna', 'index')->name('kepala.pengguna.index');
    Route::get('/kepala/pengguna/create', 'create')->name('kepala.pengguna.create');
    Route::post('/kepala/pengguna', 'store')->name('kepala.pengguna.store');
    Route::get('/kepala/pengguna/{pengguna}/edit', 'edit')->name('kepala.pengguna.edit');
    Route::put('/kepala/pengguna/{id}', 'update')->name('kepala.pengguna.update');
    Route::delete('/kepala/pengguna/{id}', 'delete_pengguna')->name('kepala.pengguna.destroy');
});


//Auth Controllers
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'HalLogin')->name('HalLogin');
    Route::post('/login','login')->name('loginproses');

    Route::get('/register', 'HalRegister')->name('HalRegister');
    Route::post('/registerproses', 'register')->name('registerproses'); 

    // Route::post('/logout', 'logout')->name('logout');
    Route::get('/dashboard', 'dashboard')->name('anggota.dashboard');

});

Route::post('/petugas/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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

Route::get('/petugas/dashboard', [AuthController::class, 'petugasDashboard'])->name('petugasDashboard')->middleware('auth');

Route::get('/kepala/dashboard', [AuthController::class, 'kepalaDashboard'])->name('kepalaDashboard')->middleware('auth');
