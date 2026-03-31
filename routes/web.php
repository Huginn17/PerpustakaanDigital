<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
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

//Auth Controllers
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'HalLogin')->name('HalLogin');
    Route::post('/login', 'login')->name('loginproses');

    Route::get('/register', 'HalRegister')->name('HalRegister');
    Route::post('/registerproses', 'register')->name('registerproses');

    Route::post('/logout', 'logout')->name('logout');
    Route::get('/dashboard', 'dashboard')->name('anggota.dashboard');

});

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
