@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <div class="p-6 sm:ml-64 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto mt-4">

            {{-- Header Page --}}
            <div class="mb-8 flex items-center space-x-5">
                <div class="h-14 w-2 bg-indigo-600 rounded-full"></div>
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Akun Kepala Perpustakaan</h1>
                    <p class="text-slate-500 font-medium">Manajemen identitas tingkat pimpinan perpustakaan.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

                {{-- Notification --}}
                @if (session('success'))
                    <div class="m-8 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-2xl animate-fade-in-down">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 font-bold text-emerald-800">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('profile.update.kepala') }}" method="POST" enctype="multipart/form-data"
                    class="p-10">
                    @csrf

                    <div class="flex flex-col lg:flex-row gap-12">

                        {{-- SISI KIRI: PROFIL FOTO --}}
                        <div class="lg:w-1/3 flex flex-col items-center">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-tr from-indigo-600 to-slate-800 rounded-full blur opacity-30 group-hover:opacity-60 transition duration-1000">
                                </div>
                                @if ($kepala->foto_profil)
                                    <img src="{{ asset('storage/' . $kepala->foto_profil) }}"
                                        class="relative w-48 h-48 rounded-full object-cover border-8 border-white shadow-2xl transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div
                                        class="relative w-48 h-48 rounded-full bg-slate-100 border-8 border-white flex items-center justify-center shadow-2xl">
                                        <svg class="w-24 h-24 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif

                                <label
                                    class="absolute bottom-4 right-4 bg-slate-800 text-white p-3 rounded-2xl cursor-pointer hover:bg-indigo-600 shadow-xl transition-all border-4 border-white transform hover:rotate-12">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    </svg>
                                    <input type="file" name="foto_profil" class="hidden">
                                </label>
                            </div>
                            <div class="mt-6 text-center">
                                <span
                                    class="px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-black uppercase tracking-widest rounded-full border border-indigo-100">
                                    Chief Librarian
                                </span>
                            </div>
                        </div>

                        {{-- SISI KANAN: INPUT DATA --}}
                        <div class="lg:w-2/3 space-y-6">

                            {{-- NAMA --}}
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-slate-600 flex items-center uppercase tracking-wide ml-1">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama_lengkap" value="{{ $kepala->nama_lengkap }}"
                                    placeholder="Nama Lengkap"
                                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-semibold text-slate-700">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- NOMOR INDUK --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-600 uppercase tracking-wide ml-1">Nomor Induk
                                        Pegawai</label>
                                    <input type="text" name="nomor_induk" value="{{ $kepala->nomor_induk }}"
                                        placeholder="NIP..."
                                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-semibold text-slate-700">
                                </div>

                                {{-- JK --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-600 uppercase tracking-wide ml-1">Jenis
                                        Kelamin</label>
                                    <div class="relative">
                                        <select name="jenis_kelamin"
                                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 appearance-none">
                                            <option value="">Pilih Gender</option>
                                            <option value="L" {{ $kepala->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ $kepala->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TANGGAL LAHIR --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600 uppercase tracking-wide ml-1">Tanggal
                                    Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $kepala->tanggal_lahir }}"
                                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all outline-none font-semibold text-slate-700">
                            </div>

                            {{-- ALAMAT --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600 uppercase tracking-wide ml-1">Alamat
                                    Resmi</label>
                                <textarea name="alamat" rows="3" placeholder="Alamat lengkap..."
                                    class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 resize-none">{{ $kepala->alamat }}</textarea>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full bg-slate-800 text-white font-black py-5 rounded-3xl shadow-xl shadow-slate-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-3">
                                    <span>SIMPAN PERUBAHAN DATA</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-400 text-xs mt-10 uppercase tracking-[0.2em] font-bold">Administrator Authority
                &bull; System 2026</p>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>
@endsection
