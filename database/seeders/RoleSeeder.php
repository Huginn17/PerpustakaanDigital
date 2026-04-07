<?php

namespace Database\Seeders;

use App\Models\KepalaPerpustakaan;
use App\Models\Petugas;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // ======================
        // KEPALA PERPUSTAKAAN
        // ======================
        $kepalaUser = User::create([
            'username' => 'superadmin',
            'email' => 'kepala@perpus.com',
            'password' => Hash::make('123456'),
            'role' => 'kepala_perpustakaan'
        ]);

        KepalaPerpustakaan::create([
            'user_id' => $kepalaUser->id,
            'nama_lengkap' => 'Budi Santoso',
            'nomor_induk' => '861324673',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1980-01-01',
            'alamat' => 'Bandung'
        ]);

        // ======================
        // PETUGAS
        // ======================
        $petugasUser = User::create([
            'username' => 'petugas',
            'email' => 'petugas@perpus.com',
            'password' => Hash::make('123456'),
            'role' => 'petugas'
        ]);

        Petugas::create([
            'user_id' => $petugasUser->id,
            'nama_lengkap' => 'Siti Aminah',
            'nomor_induk' => '36645328',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '1995-05-10',
            'alamat' => 'Bandung'
        ]);

    }
}
