<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KepalaPerpustakaan;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $pengguna = User::all();

        return view('kepala_perpus.kelola_pengguna.index', [
            "pengguna" => $pengguna
        ]);
    }

    public function create()
    {
        return view('kepala_perpus.kelola_pengguna.create');
    }

    public function store(Request $request)
    {
        // tentukan tabel berdasarkan role
        $table = match ($request->role) {
            'anggota' => 'anggotas',
            'petugas' => 'petugas',
            'kepala_perpustakaan' => 'kepala_perpustakaans',
            default => null,
        };

        if (!$table) {
            return back()->with('error', 'Role tidak valid');
        }

        // validasi
        $validated = $request->validate([
            "username"        => "required|max:14|unique:users,username",
            "email"           => "required|email|unique:users,email",
            "password"        => "required|min:6",
            "role"            => "required",
            "nama_lengkap"    => "required|string|min:4|max:32",
            "nomor_induk"     => "required|numeric|unique:$table,nomor_induk",
            "jenis_kelamin"   => "required",
            "tanggal_lahir"   => "required|date",
            "alamat"          => "required|min:10",
        ]);

        // buat user
        $user = User::create([
            "username" => $validated['username'],
            "email"    => $validated['email'],
            "password" => Hash::make($validated['password']),
            "role"     => $validated['role'],
        ]);

        // data relasi (PERBAIKAN DI SINI)
        $data = [
            "user_id"        => $user->id,
            "nama_lengkap"   => $validated['nama_lengkap'],
            "nomor_induk"    => $validated['nomor_induk'],
            "jenis_kelamin"  => $validated['jenis_kelamin'],
            "tanggal_lahir"  => $validated['tanggal_lahir'],
            "alamat"         => $validated['alamat'],
        ];

        // mapping model (array, bukan match)
        $modelMap = [
            'anggota' => Anggota::class,
            'petugas' => Petugas::class,
            'kepala_perpustakaan' => KepalaPerpustakaan::class,
        ];

        // simpan ke tabel sesuai role
        $modelMap[$validated['role']]::create($data);

        return redirect()
            ->route('kepala.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('kepala_perpus.kelola_pengguna.edit', [
            "user" => $user
        ]);
    }


    public function detail_pengguna(User $user)
    {
        return view('kepala_perpus.kelola_pengguna.detail', [
            "user" => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // dd($request->all());
        $roleValidasi = $request->role; // gunakan role lama untuk validasi nomor_induk
        // tentukan tabel berdasarkan role
        $table = match ($roleValidasi) {
            'anggota' => 'anggotas',
            'petugas' => 'petugas',
            'kepala_perpustakaan' => 'kepala_perpustakaans',
            default => null,
        };

        if (!$table) {
            return back()->with('error', 'Role tidak valid');
        }

        // ambil ID relasi untuk ignore unique
        $relasiId = match ($roleValidasi) {
            'anggota' => $user->anggota->id ?? null,
            'petugas' => $user->petugas->id ?? null,
            'kepala_perpustakaan' => $user->kepala_perpustakaan->id ?? null,
            default => null,
        };


        // validasi
        $validated = $request->validate([
            "username" => [
                "required",
                "max:14",
                Rule::unique('users', 'username')->ignore($user->id, 'id'),
            ],
            "email" => [
                "required",
                "email",
                Rule::unique('users', 'email')->ignore($user->id, 'id'),
            ],
            "password"      => "nullable|min:6",
            "role"          => "required",
            "nama_lengkap"  => "required|string|min:4|max:32",
            "nomor_induk" => [
                "required",
                "string",
                $relasiId
                    ? Rule::unique($table, 'nomor_induk')->ignore($relasiId)
                    : Rule::unique($table, 'nomor_induk'),
            ],
            "jenis_kelamin" => "required",
            "tanggal_lahir" => "required|date",
            "alamat"        => "required|min:5",
        ]);

        // dd('masuk update');



        // proteksi kepala perpustakaan
        if ($user->role === 'kepala_perpustakaan' && $validated['role'] !== 'kepala_perpustakaan') {
            $jumlah = User::where('role', 'kepala_perpustakaan')->count();

            if ($jumlah <= 1) {
                return back()->with('error', 'Minimal harus ada 1 kepala perpustakaan.');
            }
        }

        $roleLama = $user->getOriginal('role');

        // update user
        $user->update([
            "username" => $validated['username'],
            "email"    => $validated['email'],
            "role"     => $validated['role'],
            "password" => $validated['password']
                ? bcrypt($validated['password'])
                : $user->password,
        ]);

        // mapping model & relasi
        $modelMap = [
            'anggota' => Anggota::class,
            'petugas' => Petugas::class,
            'kepala_perpustakaan' => KepalaPerpustakaan::class,
        ];

        $relasiMap = [
            'anggota' => 'anggota',
            'petugas' => 'petugas',
            'kepala_perpustakaan' => 'kepala_perpustakaan',
        ];


        $roleBaru = $validated['role'];

        // hapus relasi lama jika role berubah
        if ($roleLama !== $roleBaru && isset($relasiMap[$roleLama])) {
            $oldRelasi = $user->{$relasiMap[$roleLama]};
            if ($oldRelasi) {
                $oldRelasi->delete();
            }
        }

        // refresh user untuk mengambil relasi baru
        $user->refresh();

        $relasiNama = $relasiMap[$roleBaru];

        $dataRelasi = [
            'user_id'        => $user->id,
            'nama_lengkap'   => $validated['nama_lengkap'],
            'nomor_induk'    => $validated['nomor_induk'],
            'jenis_kelamin'  => $validated['jenis_kelamin'],
            'tanggal_lahir'  => $validated['tanggal_lahir'],
            'alamat'         => $validated['alamat'],
        ];

        $relasi = $user->$relasiNama;

        if ($relasi) {
            $relasi->update($dataRelasi);
        } else {
            $user->$relasiNama()->create($dataRelasi);
        }


        return redirect()->route('kepala.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Delete Penggguna
    public function delete_pengguna($id)
    {
        //
        $user = User::findOrFail($id);

        $jumlahKepala = User::where('role', 'kepala_perpustakaan')->count();

        if ($user->role === 'kepala_perpustakaan' && $jumlahKepala <= 1) {
            return back()->with('error', "Gagal!, Tidak dapat Menghapus <br> Akun Default.");
        }

        // if ($user->foto_profile && Storage::disk('public')->exists($user->profile_photo)) {
        //     Storage::disk('public')->delete($user->foto_profile);
        // }

        $user->delete();

        return redirect()->route('kepala.pengguna.index')
            ->with('success', 'Success!, Berhasil Menghapus Akun.');
    }
}
