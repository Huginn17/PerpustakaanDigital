<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use App\Models\Setting;
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

    public function pinjam(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'tanggal_jatuh_tempo' => 'required|date'
        ]);

        $setting = Setting::first();

        $today = now()->startOfDay();
        $jatuhTempo = \Carbon\Carbon::parse($request->tanggal_jatuh_tempo);

        $maxTanggal = $today->copy()->addDays($setting->max_hari_pinjam ?? 14);

        // VALIDASI MAX HARI 🔥
        if ($jatuhTempo->gt($maxTanggal)) {
            return back()->with('error', 'Melebihi batas maksimal peminjaman');
        }

        PeminjamanBuku::create([
            'buku_id' => $request->buku_id,
            'anggota_id' => auth()->user()->anggota->id,
            'tanggal_pinjam' => $today,
            'tanggal_jatuh_tempo' => $jatuhTempo,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil');
    }

    // Ajukan Pinjaman Buku
    public function PeminjamanBuku(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'tanggal_jatuh_tempo' => 'required|date'
        ]);

        $user = Auth::user();

        if (!$user->anggota) {
            return back()->with('error', 'Kamu bukan anggota, silakan daftar terlebih dahulu!');
        }

        $anggota_id = $user->anggota->id;

        $today = Carbon::today('Asia/Jakarta');

        $setting = Setting::first();
        $maxHari = $setting->max_hari_pinjam ?? 14;

        // 🔥 FIX DI SINI
        $jatuhTempo = Carbon::createFromFormat('Y-m-d', $request->tanggal_jatuh_tempo);

        // VALIDASI
        if ($jatuhTempo->lt($today)) {
            return back()->with('error', 'Tanggal jatuh tempo tidak valid');
        }

        if ($jatuhTempo->gt($today->copy()->addDays($maxHari))) {
            return back()->with('error', "Maksimal peminjaman hanya {$maxHari} hari");
        }

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stock_buku <= 0) {
            return back()->with('error', 'Stok buku kosong!');
        }

        $pinjaman = PeminjamanBuku::where('anggota_id', $anggota_id)
            ->where('status', 'dipinjam')
            ->count();

        if ($pinjaman >= 3) {
            return back()->with('error', 'Batas maksimal pinjaman adalah 3 buku');
        }

        $pending = PeminjamanBuku::where('anggota_id', $anggota_id)
            ->where('status', 'pending')
            ->count();

        if ($pending >= 3) {
            return back()->with('error', 'Batas pengajuan buku sudah tercapai');
        }

        $denda = PeminjamanBuku::where('anggota_id', $anggota_id)
            ->where('status', 'menunggu_pembayaran')
            ->count();

        if ($denda > 0) {
            return back()->with('error', 'Masih ada denda yang belum dibayar');
        }

        PeminjamanBuku::create([
            'buku_id' => $request->buku_id,
            'anggota_id' => $anggota_id,
            'tanggal_pinjam' => $today,
            'tanggal_jatuh_tempo' => $jatuhTempo,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan berhasil, tunggu konfirmasi petugas');
    }


    public function setujui(Request $request, $id)
    {
        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])
            ->lockForUpdate()
            ->findOrFail($id);

        // validasi status
        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Status tidak valid!');
        }

        if ($peminjaman->buku->stock_buku <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        if ($peminjaman->anggota->jumlah_pinjam_aktif >= $peminjaman->anggota->max_pinjam) {
            return back()->with('error', 'Maksimal peminjaman tercapai!');
        }

        /*
    |--------------------------------------------------
    | 🔥 CEK APAKAH SUDAH ADA REQUEST JATUH TEMPO
    |--------------------------------------------------
    */
        if ($peminjaman->tanggal_jatuh_tempo) {
            // pakai tanggal dari anggota
            $tanggalJatuhTempo = $peminjaman->tanggal_jatuh_tempo;
        } else {
            // kalau tidak ada → wajib input dari petugas
            $request->validate([
                'tanggal_jatuh_tempo' => 'required|date|after:today'
            ]);

            $tanggalJatuhTempo = $request->tanggal_jatuh_tempo;
        }

        DB::transaction(function () use ($peminjaman, $tanggalJatuhTempo) {

            $peminjaman->update([
                'status' => 'dipinjam',
                'tanggal_pinjam' => now(),
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
                'petugas_id' => auth()->user()->petugas->id
            ]);

            $peminjaman->buku->decrement('stock_buku');
            $peminjaman->anggota->increment('jumlah_pinjam_aktif');
        });

        return back()->with('success', 'Peminjaman disetujui');
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
