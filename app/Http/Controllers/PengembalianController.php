<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pembayaran;
use App\Models\PeminjamanBuku;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PengembalianController extends Controller
{
    // public function formPengembalian($id)
    // {

    //     $peminjaman = PeminjamanBuku::with(['user', 'buku'])->findOrFail($id);

    //     return view('petugas.peminjaman.pengembalian', compact('peminjaman'));
    // }

    // public function pengembalian(Request $request, $id)
    // {
    //     $peminjaman = PeminjamanBuku::findOrFail($id);

    //     // validasi status
    //     if (!in_array($peminjaman->status, ['dipinjam', 'menunggu_konfirmasi'])) {
    //         return back()->with('error', 'Status tidak valid untuk pengembalian');
    //     }

    //     // set tanggal kembali
    //     $today = Carbon::now();
    //     $peminjaman->update([
    //         'tanggal_kembalikan' => $today,
    //         'status' => 'dikembalikan'
    //     ]);

    //     /*
    // |--------------------------------------------------------------------------
    // | 🔹 1. CEK TERLAMBAT
    // |--------------------------------------------------------------------------
    // */

    //     $hariTerlambat = max(
    //         0,
    //         $today->diffInDays(Carbon::parse($peminjaman->tanggal_jatuh_tempo))
    //     );

    //     if ($hariTerlambat > 0) {
    //         $dendaTerlambat = $hariTerlambat * 10000; // contoh: 10rb/hari

    //         Denda::create([
    //             'peminjaman_id' => $peminjaman->id,
    //             'jenis' => 'terlambat',
    //             'nominal' => $dendaTerlambat,
    //             'keterangan' => "Terlambat {$hariTerlambat} hari",
    //         ]);
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | 🔹 2. KONDISI BUKU
    // |--------------------------------------------------------------------------
    // */

    //     $kondisi = $request->kondisi;
    //     // normal | rusak | hilang

    //     if ($kondisi === 'rusak') {

    //         /*
    //     |--------------------------------------------------------------------------
    //     | 🔸 PENILAIAN KERUSAKAN
    //     |--------------------------------------------------------------------------
    //     */

    //         $tingkat = $request->tingkat_kerusakan;

    //         $defaultDenda = [
    //             'ringan' => 5000,
    //             'sedang' => 20000,
    //             'berat'  => 50000
    //         ];

    //         $nominal = $defaultDenda[$tingkat];

    //         // override nominal
    //         if ($request->filled('nominal_custom')) {
    //             $nominal = $request->nominal_custom;

    //             if (!$request->filled('keterangan')) {
    //                 return back()->with('error', 'Keterangan wajib jika override nominal');
    //             }
    //         }

    //         Denda::create([
    //             'peminjaman_id' => $peminjaman->id,
    //             'jenis' => 'rusak',
    //             'tingkat_kerusakan' => $tingkat,
    //             'nominal' => $nominal,
    //             'keterangan' => $request->keterangan,
    //         ]);
    //     }

    //     if ($kondisi === 'hilang') {

    //         /*
    //     |--------------------------------------------------------------------------
    //     | DENDA HILANG
    //     |--------------------------------------------------------------------------
    //     */

    //         $hargaBuku = $peminjaman->buku->harga ?? 200000;

    //         Denda::create([
    //             'peminjaman_id' => $peminjaman->id,
    //             'jenis' => 'hilang',
    //             'nominal' => $hargaBuku,
    //             'keterangan' => 'Buku hilang',
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Pengembalian berhasil diproses');
    // }







    public function prosesPengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:normal,rusak,hilang',
            'tingkat_kerusakan' => 'nullable|in:ringan,sedang,berat',
            'denda_kerusakan' => 'nullable|numeric|min:0'
        ]);

        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])->findOrFail($id);

        if ($peminjaman->status !== 'menunggu_konfirmasi') {
            return back()->with('error', 'Pengembalian hanya bisa dari status menunggu konfirmasi');
        }

        /*
    |------------------------------------------------------------------
    | 1. HAPUS DENDA LAMA
    |------------------------------------------------------------------
    */
        Denda::where('peminjaman_id', $peminjaman->id)->delete();

        /*
    |------------------------------------------------------------------
    | 2. FIX TIMEZONE 🔥
    |------------------------------------------------------------------
    */
        $today = Carbon::today('Asia/Jakarta');

        // 🔥 FIX: jangan parse langsung
        $jatuhTempo = Carbon::createFromFormat('Y-m-d', $peminjaman->tanggal_jatuh_tempo);

        /*
    |------------------------------------------------------------------
    | 3. HITUNG TERLAMBAT
    |------------------------------------------------------------------
    */
        $hariTerlambat = $jatuhTempo->diffInDays($today, false);
        $hariTerlambat = max(0, $hariTerlambat);

        $dendaPerHari = optional(Setting::first())->denda_per_hari ?? 10000;

        if ($hariTerlambat > 0) {
            Denda::create([
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'terlambat',
                'nominal' => $hariTerlambat * $dendaPerHari,
                'keterangan' => "Terlambat {$hariTerlambat} hari (Rp " . number_format($dendaPerHari, 0, ',', '.') . "/hari)",
                'status' => 'aktif'
            ]);
        }

        /*
    |------------------------------------------------------------------
    | 4. DENDA KERUSAKAN / HILANG
    |------------------------------------------------------------------
    */
        if (in_array($request->kondisi, ['rusak', 'hilang'])) {

            $dendaKerusakan = $request->denda_kerusakan ?? 0;

            if ($dendaKerusakan <= 0) {
                return back()->with('error', 'Nominal kerusakan / hilang wajib diisi');
            }

            Denda::create([
                'peminjaman_id' => $peminjaman->id,
                'jenis' => $request->kondisi,
                'tingkat_kerusakan' => $request->kondisi === 'rusak'
                    ? $request->tingkat_kerusakan
                    : null,
                'nominal' => $dendaKerusakan,
                'keterangan' => $request->kondisi === 'hilang'
                    ? 'Buku hilang (input manual)'
                    : 'Kerusakan buku (' . $request->tingkat_kerusakan . ')',
                'status' => 'aktif'
            ]);
        }

        /*
    |------------------------------------------------------------------
    | 5. KEMBALIKAN STOK
    |------------------------------------------------------------------
    */
        if ($peminjaman->buku && $request->kondisi !== 'hilang') {
            $peminjaman->buku->increment('stock_buku');
        }

        /*
    |------------------------------------------------------------------
    | 6. CEK DENDA
    |------------------------------------------------------------------
    */
        $totalDenda = Denda::where('peminjaman_id', $peminjaman->id)
            ->where('status', 'aktif')
            ->sum('nominal');

        /*
    |------------------------------------------------------------------
    | 7. UPDATE STATUS
    |------------------------------------------------------------------
    */
        if ($totalDenda > 0) {
            $peminjaman->update([
                'tanggal_kembalikan' => $today,
                'status' => 'menunggu_pembayaran'
            ]);
        } else {
            $peminjaman->update([
                'tanggal_kembalikan' => $today,
                'status' => 'dikembalikan'
            ]);

            if ($peminjaman->anggota && $peminjaman->anggota->jumlah_pinjam_aktif > 0) {
                $peminjaman->anggota->decrement('jumlah_pinjam_aktif');
            }
        }

        return back()->with('success', 'Pengembalian berhasil diproses');
    }


    public function bolehPinjam($userId)
    {
        return !PeminjamanBuku::where('user_id', $userId)
            ->where('status', 'dikembalikan')
            ->get()
            ->contains(function ($p) {
                return !$p->isLunas();
            });
    }
}
