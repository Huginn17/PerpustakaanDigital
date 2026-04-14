<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        // CARD
        $totalBuku = Buku::count();

        $totalPeminjaman = PeminjamanBuku::where('status', 'dipinjam')->count();

        $totalPengembalian = PeminjamanBuku::where('status', 'dikembalikan')->count();

        // TABLE
        $peminjamanPending = PeminjamanBuku::with('buku', 'anggota')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $pengembalianPending = PeminjamanBuku::with('buku', 'anggota')
            ->where('status', 'menunggu_konfirmasi') // atau menunggu konfirmasi pengembalian
            ->latest()
            ->get();

        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalPeminjaman',
            'totalPengembalian',
            'peminjamanPending',
            'pengembalianPending'
        ));
    }
}
