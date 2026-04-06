<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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



    public function setujui(Request $request, $id)
    {
        $request->validate([
            'tanggal_jatuh_tempo' => 'required|date|after:today'
        ]);

        try {
            DB::transaction(function () use ($id, $request) {

                $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])
                    ->lockForUpdate()
                    ->findOrFail($id);

                if ($peminjaman->status !== 'pending') {
                    throw new \Exception('Status tidak valid!');
                }

                if ($peminjaman->buku->stock_buku <= 0) {
                    throw new \Exception('Stok buku habis!');
                }

                if ($peminjaman->anggota->jumlah_pinjam_aktif >= $peminjaman->anggota->max_pinjam) {
                    throw new \Exception('Maksimal peminjaman tercapai!');
                }

                $peminjaman->update([
                    'status' => 'dipinjam',
                    'tanggal_pinjam' => now(),
                    'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                    'petugas_id' => auth()->user()->petugas->id
                ]);

                $peminjaman->buku->decrement('stock_buku');
                $peminjaman->anggota->increment('jumlah_pinjam_aktif');
            });

            return back()->with('success', 'Peminjaman disetujui');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'nullable|string|max:255'
        ]);

        try {
            DB::transaction(function () use ($id, $request) {

                $peminjaman = PeminjamanBuku::lockForUpdate()->findOrFail($id);

                // validasi status
                if ($peminjaman->status !== 'pending') {
                    throw new \Exception('Status tidak valid!');
                }

                $peminjaman->update([
                    'status' => 'ditolak',
                    'petugas_id' => auth()->user()->petugas->id,
                    'alasan_penolakan' => $request->alasan
                ]);
            });

            return back()->with('success', 'Pengajuan ditolak');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
