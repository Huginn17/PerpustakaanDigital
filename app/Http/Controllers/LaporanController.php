<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {

        $query = PeminjamanBuku::with(['anggota', 'buku', 'petugas']);

        // FILTER STATUS
        if ($request->status) {
            if ($request->status == 'peminjaman') {
                $query->where('status', 'dipinjam');
            } elseif ($request->status == 'pengembalian') {
                $query->where('status', 'dikembalikan');
            }
        }

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('anggota', function ($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                })->orWhereHas('buku', function ($q2) use ($request) {
                    $q2->where('judul_buku', 'like', '%' . $request->search . '%');
                })->orWhereHas('anggota.user', function ($q2) use ($request) {
                    $q2->where('username', 'like', '%' . $request->search . '%');
                });
            });
        }

        $data = $query->latest()->paginate(10);

        return view('petugas.laporan.index', compact('data'));
    }


    public function indexKepala(Request $request)
    {

        $query = PeminjamanBuku::with(['anggota', 'buku', 'petugas']);

        // FILTER STATUS
        if ($request->status) {
            if ($request->status == 'peminjaman') {
                $query->where('status', 'dipinjam');
            } elseif ($request->status == 'pengembalian') {
                $query->where('status', 'dikembalikan');
            }
        }

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('anggota', function ($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                })->orWhereHas('buku', function ($q2) use ($request) {
                    $q2->where('judul_buku', 'like', '%' . $request->search . '%');
                })->orWhereHas('anggota.user', function ($q2) use ($request) {
                    $q2->where('username', 'like', '%' . $request->search . '%');
                });
            });
        }

        $data = $query->latest()->paginate(10);

        return view('kepala_perpus.laporan.index', compact('data'));
    }


    public function exportPdf(Request $request)
    {
        $query = PeminjamanBuku::with(['anggota', 'buku', 'petugas']);

        // filter
        if ($request->status) {
            if ($request->status == 'peminjaman') {
                $query->where('status', 'dipinjam');
            } elseif ($request->status == 'pengembalian') {
                $query->where('status', 'dikembalikan');
            }
        }

        // search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('anggota', function ($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                })->orWhereHas('buku', function ($q2) use ($request) {
                    $q2->where('judul_buku', 'like', '%' . $request->search . '%');
                });
            });
        }

        $data = $query->get();

        $pdf = Pdf::loadView('petugas.laporan.pdf', compact('data'));

        return $pdf->download('laporan-perpustakaan.pdf');
    }


     public function exportPdfKepeala(Request $request)
    {
        $query = PeminjamanBuku::with(['anggota', 'buku', 'petugas']);

        // filter
        if ($request->status) {
            if ($request->status == 'peminjaman') {
                $query->where('status', 'dipinjam');
            } elseif ($request->status == 'pengembalian') {
                $query->where('status', 'dikembalikan');
            }
        }

        // search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('anggota', function ($q2) use ($request) {
                    $q2->where('nama_lengkap', 'like', '%' . $request->search . '%');
                })->orWhereHas('buku', function ($q2) use ($request) {
                    $q2->where('judul_buku', 'like', '%' . $request->search . '%');
                });
            });
        }

        $data = $query->get();

        $pdf = Pdf::loadView('kepala_perpus.laporan.pdf', compact('data'));

        return $pdf->download('laporan-perpustakaan.pdf');
    }
}
