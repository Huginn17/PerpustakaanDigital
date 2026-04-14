<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Pembayaran;
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

    public function buku(Request $request)
    {
        $search = $request->search;

        $bukus = Buku::when($search, function ($query, $search) {
            return $query->where('judul_buku', 'like', '%' . $search . '%')
                ->orWhere('penulis', 'like', '%' . $search . '%')
                ->orWhere('kode_buku', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('anggota.peminjaman.index', compact('bukus', 'search'));
    }


    public function dashboard()
    {
        $anggota = Auth::user()->anggota;

        //  jumlah buku dipinjam (aktif)
        $totalDipinjam = PeminjamanBuku::where('anggota_id', $anggota->id)
            ->where('status', 'dipinjam')
            ->count();

        //  total pengembalian
        $totalKembali = PeminjamanBuku::where('anggota_id', $anggota->id)
            ->where('status', 'dikembalikan')
            ->count();

        //  TOTAL DENDA REAL (dikurangi pembayaran)
        $totalDenda = Denda::whereHas('peminjaman', function ($q) use ($anggota) {
            $q->where('anggota_id', $anggota->id);
        })->sum('nominal');

        $totalBayar = Pembayaran::whereHas('peminjaman', function ($q) use ($anggota) {
            $q->where('anggota_id', $anggota->id);
        })->where('tipe', 'bayar')->sum('nominal');

        $totalDenda = max(0, $totalDenda - $totalBayar);

        //  buku terlambat
        $totalTerlambat = PeminjamanBuku::where('anggota_id', $anggota->id)
            ->where('status', 'dipinjam')
            ->whereDate('tanggal_jatuh_tempo', '<', now())
            ->count();

        //  jumlah transaksi yang belum bayar
        $jumlahDendaBelumBayar = PeminjamanBuku::where('anggota_id', $anggota->id)
            ->where('status', 'menunggu_pembayaran')
            ->count();

        // aktivitas terbaru
        $aktivitas = PeminjamanBuku::with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->take(5)
            ->get();

        return view('anggota.dashboard', compact(
            'totalDipinjam',
            'totalKembali',
            'totalTerlambat',
            'totalDenda',
            'jumlahDendaBelumBayar',
            'aktivitas'
        ));
    }


    public function detailBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $setting = Setting::first();

        return view('anggota.daftarBuku.detail', compact('buku', 'setting'));
    }

    public function peminjamanKonfir()
    {
        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])
            ->where('status', 'pending')
            ->get();

        $peminjamanSelesai = PeminjamanBuku::with('buku', 'anggota')
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('petugas.peminjaman.pengembalian', compact('peminjaman', 'peminjamanSelesai'));
    }

    public function pengajuanPengembalian()
    {
        // $data = PeminjamanBuku::with(['user', 'buku'])
        //     ->whereIn('status', ['menunggu_konfirmasi', 'menunggu_pembayaran'])
        //     ->latest()
        //     ->get();

        // HITUNG DENDA (yang masih diproses)
        $prosesDenda = PeminjamanBuku::with('buku', 'anggota')
            ->whereIn('status', ['dipinjam', 'menunggu_konfirmasi'])
            ->get();

        // PEMBAYARAN DENDA
        $pembayaranDenda = PeminjamanBuku::with('buku', 'anggota')
            ->where('status', 'menunggu_pembayaran')
            ->get();

        $setting = Setting::first();

        return view('petugas.peminjaman.index', compact('prosesDenda', 'pembayaranDenda', 'setting'));
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
            ->where('anggota_id', $anggotaId)
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
        $totalBuku = Buku::count();
        $totalStok = Buku::sum('stock_buku');

        $dipinjam = PeminjamanBuku::where('status', 'dipinjam')->count();

        $dikembalikanHariIni = PeminjamanBuku::whereDate('tanggal_kembalikan', now())->count();

        $totalDenda = Denda::where('status', 'aktif')->sum('nominal');

        $anggota = Anggota::count();

        $aktivitas = PeminjamanBuku::with(['buku', 'anggota'])
            ->latest()
            ->take(10)
            ->get();

        return view('kepala_perpus.dashboard', compact(
            'totalBuku',
            'totalStok',
            'dipinjam',
            'dikembalikanHariIni',
            'totalDenda',
            'anggota',
            'aktivitas'
        ));
    }
}
