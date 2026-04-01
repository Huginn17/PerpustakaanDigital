<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuController extends Controller
{

    public function index()
    {
        $bukus = Buku::all();
        return view('anggota.peminjaman.index', compact('bukus'));
    }
    // Ajukan Pinjaman Buku
    public function PeminjamanBuku(Request $request)
    {
        $buku_id = $request->buku_id;
        // Jika pengguna ini bukan anggota, maka return error
        $user = Auth::user();
        if (!$user->anggota) {
            return back()->with('error', 'sepertinya kamu bukan anggota, silahkan daftar terlebih dahulu untuk bisa meminjam buku!');
        }   
        $anggota_id = Auth::user()->Anggota->id;


        // Waktu Saat Ini
        $WaktuIni = Carbon::now();
        // Ambil Data Buku
        $buku = Buku::findOrFail($buku_id);

        // Cek apakah Stok Buku Tersebut Tersedia?
        if ($buku->stok_buku === 0) {
            return back()->with('error', 'Mohon Maaf, stok buku ini kosong!');
        }

        // Cek pengguna ini sedang pinjam buku sebanyakk 3 buku?
        $pinjaman = PeminjamanBuku::where('anggota_id', $anggota_id)->where('status', 'dipinjam')->count();
        if ($pinjaman === 3 || $pinjaman >= 3) {
            return back()->with('error', 'Jumlah Pinjaman kamu sudah Mencapai batas pinjaman, silahkan kembalikan buku pinjamanmu terlebih dahulu!');
        }

        // batas pengajuan atau nunggu konfirmasi dulu,
        $batas_pengajuan_pending = PeminjamanBuku::where('anggota_id', $anggota_id)->where('status', 'pending')->count();
        if ($batas_pengajuan_pending === 2 || $batas_pengajuan_pending >= 2) {
            return back()->with('error', 'kamu telah mencapai batas pengajuan buku');
        }

        PeminjamanBuku::create([
            "buku_id"         =>   $buku_id,
            "anggota_id"      =>   $anggota_id,
            "tanggal_pinjam"  =>   $WaktuIni
        ]);

        return back()->with('success', 'selamat, pengajuan buku berhasil silahkan menunggu konfirmasi..');
    }
}
