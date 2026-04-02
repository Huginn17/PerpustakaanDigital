@extends('kepala_perpus.layout.index')

@section('kepala_content')
<div class="p-6 sm:ml-64 min-h-screen bg-gray-50/50">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Edit Pengguna</h1>
            <p class="text-gray-500 mt-1">Perbarui informasi akun dan profil pengguna di sini.</p>
        </div>
        <a href="{{ route('kepala.pengguna.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="max-w-4xl mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 shadow-sm animate-pulse">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="font-bold">Terjadi Kesalahan!</span>
            </div>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-4xl bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <form action="{{ route('kepala.pengguna.update', $user->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            @php
                $relasi = $user->anggota ?? ($user->petugas ?? $user->kepala_perpustakaans);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Akun
                    </h2>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-blue-500 transition">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition-all" placeholder="Masukkan username">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-blue-500 transition">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition-all" placeholder="email@contoh.com">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-blue-500 transition">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition-all" placeholder="••••••••">
                        <p class="text-xs text-gray-400 mt-1 italic">*Kosongkan jika tidak ingin mengubah password</p>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Role / Jabatan</label>
                        <select name="role" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition-all appearance-none cursor-pointer">
                            <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="kepala_perpustakaan" {{ $user->role == 'kepala_perpustakaan' ? 'selected' : '' }}>Kepala Perpustakaan</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-5 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-5 0h4"></path></svg>
                        Profil Pribadi
                    </h2>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-green-500 transition">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ $relasi->nama_lengkap ?? '' }}" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-400 outline-none transition-all" placeholder="Nama Lengkap">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-green-500 transition">Nomor Induk (NIP/NIS)</label>
                        <input type="text" name="nomor_induk" value="{{ $relasi->nomor_induk ?? '' }}" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-400 outline-none transition-all" placeholder="123456789">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                            <select name="jenis_kelamin" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-400 outline-none cursor-pointer">
                                <option value="L" {{ ($relasi->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ ($relasi->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Tgl Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ $relasi->tanggal_lahir ?? '' }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-400 outline-none transition-all">
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-600 mb-1 group-focus-within:text-green-500 transition">Alamat</label>
                        <textarea name="alamat" rows="3" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-400 outline-none transition-all resize-none" placeholder="Alamat domisili...">{{ $relasi->alamat ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end space-x-3">
                <button type="reset" class="px-6 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition duration-300">
                    Reset Form
                </button>
                <button type="submit" class="px-10 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl shadow-lg shadow-blue-200 transform hover:-translate-y-0.5 transition duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection