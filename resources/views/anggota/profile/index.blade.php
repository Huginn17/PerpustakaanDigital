@extends('anggota.layout.index')

@section('anggota')
    <div class="p-4 sm:ml-64 bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">
        <div class="max-w-3xl mx-auto mt-10">

            {{-- Header Card dengan Gradasi --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-t-3xl p-8 shadow-lg relative overflow-hidden">
                {{-- Elemen Dekoratif --}}
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 mb-[-20px] ml-[-20px] w-24 h-24 bg-purple-400/20 rounded-full blur-xl">
                </div>

                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold text-white">Pengaturan Profil</h2>
                        <p class="text-indigo-100 text-sm">Kelola informasi pribadi Anda agar tetap mutakhir.</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Main Form Card --}}
            <div class="bg-white rounded-b-3xl shadow-2xl shadow-indigo-100/50 p-8 border-x border-b border-slate-100">

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="flex items-center bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-4 mb-6 rounded-2xl shadow-md shadow-emerald-100 animate-bounce-short"
                        role="alert">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('profile.update.anggota') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Section Foto --}}
                    <div class="flex flex-col items-center sm:flex-row sm:space-x-8 pb-8 border-b border-slate-50">
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                            </div>
                            @if ($anggota->foto_profil)
                                <img src="{{ asset('storage/' . $anggota->foto_profil) }}"
                                    class="relative w-32 h-32 rounded-3xl object-cover ring-4 ring-white shadow-xl transition-all">
                            @else
                                <div
                                    class="relative w-32 h-32 rounded-3xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-500 ring-4 ring-white shadow-xl">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <label
                                class="absolute -bottom-2 -right-2 bg-gradient-to-r from-orange-500 to-pink-500 p-2.5 rounded-xl text-white cursor-pointer hover:scale-110 shadow-lg transition-all border-2 border-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <input type="file" name="foto_profil" class="hidden">
                            </label>
                        </div>
                        <div class="mt-6 sm:mt-0 text-center sm:text-left">
                            <h3
                                class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 font-extrabold text-xl">
                                Foto Profil</h3>
                            <p class="text-sm text-slate-500 mt-1">Gunakan foto terbaikmu agar mudah dikenali oleh
                                pustakawan!</p>
                        </div>
                    </div>

                    {{-- Input Fields Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        {{-- NAMA --}}
                        <div class="space-y-2 group">
                            <label class="flex items-center text-sm font-bold text-slate-700 ml-1">
                                <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                Nama Lengkap
                            </label>
                            <input type="text" name="nama_lengkap" placeholder="Masukkan nama..."
                                value="{{ $anggota->nama_lengkap }}"
                                class="w-full px-4 py-3 rounded-2xl bg-indigo-50/30 border border-indigo-100 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">
                        </div>

                        {{-- NOMOR INDUK --}}
                        <div class="space-y-2 group">
                            <label class="flex items-center text-sm font-bold text-slate-700 ml-1">
                                <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                                Nomor Induk
                            </label>
                            <input type="text" name="nomor_induk" placeholder="Masukkan nomor induk..."
                                value="{{ $anggota->nomor_induk }}"
                                class="w-full px-4 py-3 rounded-2xl bg-purple-50/30 border border-purple-100 focus:bg-white focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all outline-none">
                        </div>

                        {{-- JK --}}
                        <div class="space-y-2 group">
                            <label class="flex items-center text-sm font-bold text-slate-700 ml-1">
                                <span class="w-2 h-2 bg-pink-500 rounded-full mr-2"></span>
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <select name="jenis_kelamin"
                                    class="w-full px-4 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:bg-white focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 transition-all outline-none appearance-none">
                                    <option value="">Pilih...</option>
                                    <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                {{-- <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                                    <svg class="h-5 w-5 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div> --}}
                            </div>
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="space-y-2 group">
                            <label class="flex items-center text-sm font-bold text-slate-700 ml-1">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir }}"
                                class="w-full px-4 py-3 rounded-2xl bg-orange-50/30 border border-orange-100 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none">
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-bold text-slate-700 ml-1">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                            Alamat Domisili
                        </label>
                        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda..."
                            class="w-full px-4 py-3 rounded-2xl bg-emerald-50/30 border border-emerald-100 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none">{{ $anggota->alamat }}</textarea>
                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full group relative flex items-center justify-center px-8 py-4 font-extrabold text-white transition-all bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-[length:200%_auto] hover:bg-[right_center] rounded-2xl focus:outline-none shadow-xl shadow-indigo-200 active:scale-[0.98]">
                            <span class="mr-2 text-lg">Simpan Perubahan Profil</span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-400 text-xs mt-8 mb-10">Data Anda dilindungi enkripsi standar &bull; Library
                System v2.0</p>
        </div>
    </div>

    <style>
        @keyframes bounce-short {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .animate-bounce-short {
            animation: bounce-short 1s ease-in-out infinite;
        }
    </style>
@endsection
