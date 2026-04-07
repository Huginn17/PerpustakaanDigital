<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pembayaran;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PengembalianController extends Controller
{
    public function formPengembalian($id)
    {
        $peminjaman = PeminjamanBuku::with(['user', 'buku'])->findOrFail($id);

        return view('petugas.peminjaman.pengembalian', compact('peminjaman'));
    }

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
            'nominal' => 'nullable|numeric|min:0',
            'tingkat_kerusakan' => 'nullable|in:ringan,sedang,berat'
        ]);

        $peminjaman = PeminjamanBuku::with('buku')->findOrFail($id);

        // validasi status
        if (!in_array($peminjaman->status, ['dipinjam', 'menunggu_konfirmasi'])) {
            return back()->with('error', 'Status tidak valid');
        }

        $today = now();

        /*
    |--------------------------------------------------------------------------
    | 🔹 1. UPDATE STATUS
    |--------------------------------------------------------------------------
    */
        $peminjaman->update([
            'tanggal_kembalikan' => $today,
            'status' => 'dikembalikan'
        ]);

        /*
    |--------------------------------------------------------------------------
    | 🔹 2. DENDA TERLAMBAT
    |--------------------------------------------------------------------------
    */
        $hariTerlambat = max(
            0,
            $today->diffInDays($peminjaman->tanggal_jatuh_tempo)
        );

        if ($hariTerlambat > 0) {
            Denda::create([
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'terlambat',
                'nominal' => $hariTerlambat * 10000,
                'keterangan' => "Terlambat {$hariTerlambat} hari",
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | 🔹 3. DENDA KONDISI BUKU
    |--------------------------------------------------------------------------
    */
        if ($request->kondisi === 'rusak') {

            $defaultDenda = [
                'ringan' => 5000,
                'sedang' => 20000,
                'berat'  => 50000
            ];

            $nominal = $defaultDenda[$request->tingkat_kerusakan] ?? 0;

            // override nominal manual
            if ($request->filled('nominal_custom')) {
                $nominal = $request->nominal_custom;

                if (!$request->filled('keterangan')) {
                    return back()->with('error', 'Keterangan wajib jika override nominal');
                }
            }

            Denda::create([
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'rusak',
                'tingkat_kerusakan' => $request->tingkat_kerusakan,
                'nominal' => $nominal,
                'keterangan' => $request->keterangan,
            ]);
        }

        if ($request->kondisi === 'hilang') {

            $hargaBuku = $peminjaman->buku->harga ?? 200000;

            Denda::create([
                'peminjaman_id' => $peminjaman->id,
                'jenis' => 'hilang',
                'nominal' => $hargaBuku,
                'keterangan' => 'Buku hilang',
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | 🔹 4. PEMBAYARAN (OPSIONAL)
    |--------------------------------------------------------------------------
    */
        $totalDenda = Denda::where('peminjaman_id', $peminjaman->id)->sum('nominal');

        $totalBayar = Pembayaran::where('peminjaman_id', $peminjaman->id)
            ->where('tipe', 'bayar')
            ->sum('nominal');

        $sisa = $totalDenda - $totalBayar;

        /*
|--------------------------------------------------------------------------
| 🔹 VALIDASI PEMBAYARAN
|--------------------------------------------------------------------------
*/
        if ($request->filled('nominal')) {

            if ($request->nominal <= 0) {
                return back()->with('error', 'Nominal tidak valid');
            }

            if ($request->nominal > $sisa) {
                return back()->with('error', 'Pembayaran melebihi sisa denda');
            }

            /*
    |--------------------------------------------------------------------------
    | 🔹 SIMPAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */
            Pembayaran::create([
                'peminjaman_id' => $peminjaman->id,
                'nominal' => $request->nominal,
                'tipe' => 'bayar'
            ]);
        }

        return back()->with('success', 'Pengembalian + pembayaran berhasil');
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
