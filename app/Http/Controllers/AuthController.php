<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use App\Models\Setting;
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
            'password' => 'required|min:3|confirmed',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'anggota'
            ]);

            $user->anggota()->create([
                'max_pinjam' => 3,
                'jumlah_pinjam_aktif' => 0
            ]);
        });

        return redirect()->route('login')->with('success', 'Register berhasil');
    }

    //Login
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // cek apakah input email atau username
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([
            $field => $request->login,
            'password' => $request->password
        ])) {

            $user = Auth::user();
            $role = $user->role;

            return match ($role) {
                'anggota' => redirect()->route('anggota.dashboard'),
                'petugas' => redirect()->route('petugasDashboard'),
                'kepala_perpustakaan' => redirect()->route('kepalaDashboard'),
                default => back(),
            };
        }

        return back()->with('error', 'Username / Email atau password salah');
    }


    //Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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

    public function buku()
    {
        $bukus = Buku::all();
        return view('anggota.peminjaman.index', compact('bukus'));
    }

    public function detailBuku($id)
    {
        $buku = Buku::findOrFail($id);
        return view('anggota.daftarBuku.detail', compact('buku'));
    }

    public function petugasDashboard()
    {
        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])
            ->where('status', 'pending')
            ->get();
        return view('petugas.dashboard', compact('peminjaman'));
    }

    public function pengajuanPengembalian()
    {
        $data = PeminjamanBuku::with(['user', 'buku'])
            ->whereIn('status', ['menunggu_konfirmasi', 'menunggu_pembayaran'])
            ->latest()
            ->get();

        $Data = PeminjamanBuku::with(['buku', 'anggota', 'dendas'])
            ->where('status', 'dikembalikan')
            ->whereHas('dendas', function ($q) {
                $q->where('jenis', 'hilang');
            })
            ->latest()
            ->get();

        $setting = Setting::first();

        return view('petugas.peminjaman.index', compact('data', 'Data', 'setting'));
    }

    public function ajukanPengembalianPage()
    {
        $anggotaId = auth()->user()->anggota->id;

        if (!$anggotaId) {
            abort(403, 'Data anggota tidak ditemukan');
        }

        // semua riwayat
        $semua = PeminjamanBuku::with('buku')
            ->where('anggota_id', $anggotaId)
            ->latest()
            ->get();

        // sudah dikembalikan
        $dikembalikan = PeminjamanBuku::with('buku')
            ->where('anggota_id', $anggotaId)
            ->where('status', 'dikembalikan')
            ->latest()
            ->get();

        $data = PeminjamanBuku::with('buku')
            ->where('anggota_id', $anggotaId    )
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('anggota.pengembalian.index', compact('data', 'semua', 'dikembalikan'));
    }


    //Proses pengajuan pengembalian
    public function ajukanPengembalian($id)
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan');
        }

        $peminjaman = PeminjamanBuku::where('anggota_id', $anggota->id)
            ->where('status', 'dipinjam')
            ->findOrFail($id);

        $peminjaman->update([
            'status' => 'menunggu_konfirmasi'
        ]);

        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim');
    }

    public function kepalaDashboard()
    {
        return view('kepala_perpus.dashboard');
    }
}
