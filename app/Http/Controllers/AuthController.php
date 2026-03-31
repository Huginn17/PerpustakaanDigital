<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Proses register anggota
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'anggota'
            ]);

            $year = date('Y');

            $last = \App\Models\Anggota::whereYear('created_at', $year)->count() + 1;

            $nomorInduk = 'AGT-' . $year . '-' . str_pad($last, 4, '0', STR_PAD_LEFT);

            $user->anggota()->create([
                'nomor_induk' => $nomorInduk,
                'max_pinjam' => 3,
                'jumlah_pinjam_aktif' => 0
            ]);
        });

        return redirect('/')->with('success', 'Register berhasil');
    }

    //Login
    public function login(Request $request)
    {
        $valid = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($valid)) {

            $user = Auth::user();
            $role = $user->role;

            return match ($role) {
                'anggota' => redirect()->route('anggota.dashboard'),
                'petugas' => redirect()->route('buku.index'),
                'kepala_perpustakaan' => redirect()->route('kepala-perpustakaan.dashboard'),
                default => back(),
            };
        }

        return back();
    }


    //Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    //halaman login
    public function HalLogin()
    {
        return view('auth.login');
    }

    //halaman register
    public function HalRegister()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('anggota.dashboard');
    }
}
