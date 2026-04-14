<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $anggota = Auth::user()->anggota;

        return view('anggota.profile.index', compact('anggota'));
    }

    public function profile_petugas()
    {
        $petugas = Auth::user()->petugas;

        return view('petugas.profile.index', compact('petugas'));
    }
    public function profile_kepala()
    {
        $kepala = Auth::user()->kepala_perpustakaan;

        return view('kepala_perpus.profile.index', compact('kepala'));
    }


    public function update(Request $request)
    {
        $anggota = Auth::user()->anggota;

        $request->validate([
            'nama_lengkap' => 'nullable|string|max:255',
            'nomor_induk' => 'nullable|unique:anggotas,nomor_induk,' . $anggota->id,
            'jenis_kelamin' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload foto
        if ($request->hasFile('foto_profil')) {

            // hapus foto lama (disk public)
            if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                Storage::disk('public')->delete($anggota->foto_profil);
            }

            // simpan ke storage/app/public
            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            $anggota->foto_profil = $path;
        }

        // update data
        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_induk' => $request->nomor_induk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto_profil' => $anggota->foto_profil // penting!
        ]);

        return back()->with('success', 'Profile berhasil diupdate');
    }


    public function update_petugas(Request $request)
    {
        $petugas = Auth::user()->petugas;

        $request->validate([
            'nama_lengkap' => 'nullable|string|max:255',
            'nomor_induk' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload foto
        if ($request->hasFile('foto_profil')) {

            // hapus lama
            if ($petugas->foto_profil && Storage::disk('public')->exists($petugas->foto_profil)) {
                Storage::disk('public')->delete($petugas->foto_profil);
            }

            // simpan ke public
            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            $petugas->foto_profil = $path;
        }

        // update data
        $petugas->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_induk' => $request->nomor_induk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto_profil' => $petugas->foto_profil
        ]);

        return back()->with('success', 'Profile petugas berhasil diupdate');
    }
    public function update_kepala(Request $request)
    {
        $kepala = Auth::user()->kepala_perpustakaan;

        if (!$kepala) {
            return back()->with('error', 'Data kepala tidak ditemukan');
        }

        $request->validate([
            'nama_lengkap'   => 'nullable|string|max:255',
            'nomor_induk'    => 'nullable|string|max:100',
            'jenis_kelamin'  => 'nullable',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',
            'foto_profil'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload foto
        if ($request->hasFile('foto_profil')) {

            if ($kepala->foto_profil && Storage::disk('public')->exists($kepala->foto_profil)) {
                Storage::disk('public')->delete($kepala->foto_profil);
            }

            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            $kepala->foto_profil = $path;
        }

        // update langsung seperti petugas
        $kepala->update([
            'nama_lengkap'   => $request->nama_lengkap,
            'nomor_induk'    => $request->nomor_induk,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'foto_profil'    => $kepala->foto_profil
        ]);

        return back()->with('success', 'Profile kepala berhasil diupdate');
    }
}
