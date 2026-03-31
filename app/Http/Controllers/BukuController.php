<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('petugas')->get();
        return view('petugas.buku.index', compact('bukus'));
    }

    public function create()
    {
        $petugas = Petugas::all();
        return view('petugas.buku.create', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus',
        ]);

        $data = $request->all();

        $data = $request->only([
            'kode_buku',
            'judul_buku',
            'penulis',
            'tahun_terbit',
            'stock_buku'
        ]);

        $data['petugas_id'] = Auth::user()->petugas->id;

        // upload gambar
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $petugas = Petugas::all();

        return view('petugas.buku.edit', compact('buku', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->all();

        $data = $request->only([
            'kode_buku',
            'judul_buku',
            'penulis',
            'tahun_terbit',
            'stock_buku'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $buku->update($data);
    
        return redirect()->route('buku.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus');
    }
}
