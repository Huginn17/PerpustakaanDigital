@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <div class="p-6 sm:ml-64 bg-[#f0f2f5] min-h-screen">

        {{-- Breadcrumb & Header --}}
        <div class="mb-8">
            <h1
                class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 tracking-tight uppercase italic">
                Tambah <span class="text-gray-800">Pengguna  Baru</span>
            </h1>
            <p class="text-gray-500 font-medium">Lengkapi data di bawah untuk menambahkan entitas baru ke sistem.</p>
        </div>

        {{-- Error Validation dengan Style Pop-up --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-2 border-red-200 rounded-3xl animate-pulse">
                <div class="flex items-center mb-2 text-red-700 font-bold uppercase text-xs tracking-widest">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Ada Gangguan Input!
                </div>
                <ul class="text-red-600 text-sm font-medium space-y-1 ml-7 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Glassmorphism Card --}}
        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white p-8 md:p-12 relative overflow-hidden">
            {{-- Decorative Circle --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>

            <form action="{{ route('kepala.pengguna.store') }}" method="POST" class="relative z-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Kolom Kiri: Akun --}}
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-indigo-500 uppercase tracking-[0.2em] mb-4">Informasi Akun</h3>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Username</label>
                            <input type="text" name="username" placeholder="cth: holis_nugraha"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-indigo-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm"
                                value="{{ old('username') }}">
                        </div>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Alamat Email</label>
                            <input type="email" name="email" placeholder="email@domain.com"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-indigo-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm"
                                value="{{ old('email') }}">
                        </div>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Kata Sandi</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-indigo-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm">
                        </div>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Level Akses</label>
                            <select name="role"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-indigo-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm appearance-none">
                                <option value="">-- Pilih Akses --</option>
                                <option value="anggota">Anggota</option>
                                <option value="petugas">Petugas</option>
                                <option value="kepala_perpustakaan">Kepala Perpustakaan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Profil --}}
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-purple-500 uppercase tracking-[0.2em] mb-4">Identitas Pribadi
                        </h3>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" placeholder="Nama sesuai KTP/Kartu"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-purple-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm"
                                value="{{ old('nama_lengkap') }}">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative group">
                                <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Nomor Induk</label>
                                <input type="number" name="nomor_induk" placeholder="12345..."
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-purple-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm"
                                    value="{{ old('nomor_induk') }}">
                            </div>
                            <div class="relative group">
                                <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Gender</label>
                                <select name="jenis_kelamin"
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-purple-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm appearance-none">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-purple-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm"
                                value="{{ old('tanggal_lahir') }}">
                        </div>

                        <div class="relative group">
                            <label class="text-xs font-bold text-gray-400 uppercase ml-4 mb-1 block">Alamat Domisili</label>
                            <textarea name="alamat" rows="2" placeholder="Jl. Anggrek No. XX..."
                                class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent focus:border-purple-400 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-semibold text-gray-700 shadow-sm resize-none">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-12 flex flex-col md:flex-row gap-4 items-center justify-end border-t border-gray-100 pt-8">
                    <a href="{{ route('kepala.pengguna.index') }}"
                        class="text-gray-400 hover:text-gray-600 font-bold uppercase tracking-widest text-xs transition-colors px-6">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full md:w-auto px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black uppercase tracking-[0.1em] rounded-2xl shadow-xl shadow-indigo-200 hover:scale-105 active:scale-95 transition-all duration-300 overflow-hidden relative group">
                        <span class="relative z-10">Simpan Data Kru</span>
                        <div
                            class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Mengubah warna kalender (date picker) agar seragam */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.5) sepia(1) saturate(5) hue-rotate(200deg);
            cursor: pointer;
        }
    </style>
@endsection
