<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pembayaran;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function showPembayaran($id)
    {
        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])->findOrFail($id);

        $totalDenda = Denda::where('peminjaman_id', $id)->sum('nominal');

        $totalBayar = Pembayaran::where('peminjaman_id', $id)
            ->where('tipe', 'bayar')
            ->sum('nominal');

        $sisa = $totalDenda - $totalBayar;

        return view('petugas.peminjaman.pembayaran', compact(
            'peminjaman',
            'totalDenda',
            'totalBayar',
            'sisa'
        ));
    }


    public function formRefund($id)
    {
        $peminjaman = PeminjamanBuku::with(['buku', 'anggota'])->findOrFail($id);

        // hitung total bayar bersih (bayar - refund)
        $totalBayar = Pembayaran::where('peminjaman_id', $id)
            ->sum(DB::raw("
            CASE 
                WHEN tipe = 'bayar' THEN nominal
                WHEN tipe = 'refund' THEN -nominal
                ELSE 0
            END
        "));

        return view('petugas.peminjaman.pengembalian', compact('peminjaman', 'totalBayar'));
    }



    public function prosesRefund(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'required|string'
        ]);

        $peminjaman = PeminjamanBuku::findOrFail($id);

        if ($peminjaman->status !== 'dikembalikan') {
            return back()->with('error', 'Refund hanya bisa setelah pengembalian selesai');
        }

        // hitung total bayar bersih
        $totalBayar = Pembayaran::where('peminjaman_id', $id)
            ->sum(DB::raw("
            CASE 
                WHEN tipe = 'bayar' THEN nominal
                WHEN tipe = 'refund' THEN -nominal
                ELSE 0
            END
        "));

        if ($totalBayar <= 0) {
            return back()->with('error', 'Tidak ada pembayaran untuk direfund');
        }

        if ($request->nominal > $totalBayar) {
            return back()->with('error', 'Refund melebihi total pembayaran');
        }

        // simpan refund
        Pembayaran::create([
            'peminjaman_id' => $id,
            'nominal' => $request->nominal,
            'tipe' => 'refund',
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Refund berhasil diproses');
    }
    public function prosesPembayaran(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1'
        ]);

        $peminjaman = PeminjamanBuku::with(['anggota', 'buku'])->findOrFail($id);

        if ($peminjaman->status !== 'menunggu_pembayaran') {
            return back()->with('error', 'Tidak dalam proses pembayaran');
        }

        /*
    |--------------------------------------------------------------------------
    | 🔥 TOTAL DENDA & BAYAR
    |--------------------------------------------------------------------------
    */
        $totalDenda = Denda::where('peminjaman_id', $id)
            ->where('status', 'aktif')
            ->sum('nominal');

        $totalBayar = Pembayaran::where('peminjaman_id', $id)
            ->where('tipe', 'bayar')
            ->sum('nominal');

        $sisa = $totalDenda - $totalBayar;

        if ($request->nominal > $sisa) {
            return back()->with('error', 'Pembayaran melebihi sisa denda');
        }

        /*
    |--------------------------------------------------------------------------
    | 💾 SIMPAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */
        Pembayaran::create([
            'peminjaman_id' => $id,
            'nominal' => $request->nominal,
            'tipe' => 'bayar'
        ]);

        /*
    |--------------------------------------------------------------------------
    | 🔥 CEK LUNAS
    |--------------------------------------------------------------------------
    */
        $totalBayarBaru = $totalBayar + $request->nominal;

        if ($totalBayarBaru >= $totalDenda) {

            // gunakan timezone Indonesia
            $today = now('Asia/Jakarta')->toDateString();

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembalikan' => $today
            ]);

            // kurangi pinjaman aktif
            if ($peminjaman->anggota && $peminjaman->anggota->jumlah_pinjam_aktif > 0) {
                $peminjaman->anggota->decrement('jumlah_pinjam_aktif');
            }

        }

        return back()->with('success', 'Pembayaran berhasil');
    }
}
