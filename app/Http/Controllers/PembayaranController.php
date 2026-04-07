<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function formPembayaran($id)
    {
        $peminjaman = PeminjamanBuku::with(['user', 'buku', 'dendas', 'pembayaran'])
            ->findOrFail($id);

        return view('peminjaman.pembayaran', compact('peminjaman'));
    }
    public function bayarDenda(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1'
        ]);

        $peminjaman = PeminjamanBuku::findOrFail($id);

        // ambil sisa tagihan
        $sisa = $peminjaman->sisaTagihan();

        if ($sisa <= 0) {
            return back()->with('error', 'Tidak ada tagihan');
        }

        // simpan pembayaran
        Pembayaran::create([
            'peminjaman_id' => $peminjaman->id,
            'nominal' => $request->nominal,
            'tipe' => 'bayar'
        ]);

        return back()->with('success', 'Pembayaran berhasil');
    }
}
