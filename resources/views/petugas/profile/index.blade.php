@extends('petugas.layout.index')

@section('petugas')
    <div class="p-6 sm:ml-64 bg-[#fffaf5] min-h-screen font-sans">
        <div class="max-w-5xl mx-auto">
            <div
                class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 bg-white p-6 rounded-[2.5rem] shadow-sm border border-orange-100/50">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 bg-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-200 rotate-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-slate-800">Profil Akun</h1>
                        <p class="text-orange-500 font-medium text-sm italic">Petugas Perpustakaan</p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <span
                        class="px-4 py-2 bg-orange-50 text-orange-600 rounded-full text-xs font-bold border border-orange-100">
                        ID Petugas: #{{ $petugas->nomor_induk }}
                    </span>
                </div>
            </div>

            <form action="{{ route('profile.update.petugas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    <div class="lg:col-span-4">
                        <div
                            class="bg-white rounded-[3rem] p-8 border border-orange-100 shadow-xl shadow-orange-100/20 text-center sticky top-8">
                            <div class="relative inline-block mb-6">
                                <div class="w-44 h-44 p-2">
                                </div>
                                <div
                                    class="absolute inset-2 overflow-hidden rounded-full border-4 border-white shadow-inner">
                                    @if ($petugas->foto_profil)
                                        <img src="{{ asset('storage/' . $petugas->foto_profil) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                            <i class="fa-solid fa-user text-5xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <label
                                    class="absolute bottom-2 right-2 w-12 h-12 bg-orange-600 rounded-2xl flex items-center justify-center text-white cursor-pointer transition-all shadow-lg hover:scale-110 active:scale-95 border-4 border-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                                        </path>
                                    </svg>
                                    <input type="file" name="foto_profil" class="hidden">
                                </label>
                            </div>

                            <h2 class="text-xl font-bold text-slate-800 uppercase leading-tight">
                                {{ $petugas->nama_lengkap }}</h2>
                            <p class="text-slate-400 text-sm mb-6">{{ $petugas->nomor_induk }}</p>

                            <div class="space-y-3">
                                <div
                                    class="bg-orange-50 p-4 rounded-2xl flex items-center space-x-3 group hover:bg-orange-100 transition-colors">
                                    <div
                                        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-orange-600 shadow-sm">

                                        @if ($petugas->jenis_kelamin == 'P')
                                            <!-- ICON PEREMPUAN -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M208,96a80,80,0,1,0-88,79.6V200H88a8,8,0,0,0,0,16h32v24a8,8,0,0,0,16,0V216h32a8,8,0,0,0,0-16H136V175.6A80.11,80.11,0,0,0,208,96ZM64,96a64,64,0,1,1,64,64A64.07,64.07,0,0,1,64,96Z">
                                                </path>
                                            </svg>
                                        @else
                                            <!-- ICON LAKI-LAKI -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M216,32H168a8,8,0,0,0,0,16h28.69L154.62,90.07a80,80,0,1,0,11.31,11.31L208,59.32V88a8,8,0,0,0,16,0V40A8,8,0,0,0,216,32ZM149.24,197.29a64,64,0,1,1,0-90.53A64.1,64.1,0,0,1,149.24,197.29Z">
                                                </path>
                                            </svg>
                                        @endif

                                    </div>
                                    <div class="text-left">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">Gender</p>
                                        <p class="text-sm font-bold text-slate-700">
                                            {{ $petugas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-8">
                        <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-64 h-64 bg-orange-600/20 rounded-full blur-[80px] -mr-32 -mt-32">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-40 h-40 bg-orange-400/10 rounded-full blur-[60px] -ml-20 -mb-20">
                            </div>

                            @if (session('success'))
                                <div
                                    class="mb-8 p-4 bg-orange-600/20 border border-orange-600/30 rounded-2xl text-orange-400 flex items-center animate-fade-in">
                                    <i class="fa-solid fa-circle-check mr-3"></i>
                                    <span class="text-sm font-bold">{{ session('success') }}</span>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 gap-8 relative z-10">
                                <div class="space-y-2">
                                    <label class="text-orange-400 text-xs font-black uppercase tracking-widest ml-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama_lengkap" value="{{ $petugas->nama_lengkap }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-orange-600 focus:bg-white/10 transition-all font-medium">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label
                                            class="text-orange-400 text-xs font-black uppercase tracking-widest ml-1">Tanggal
                                            Lahir</label>
                                        <input type="date" name="tanggal_lahir" value="{{ $petugas->tanggal_lahir }}"
                                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-orange-600 transition-all font-medium">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-orange-400 text-xs font-black uppercase tracking-widest ml-1">Jenis
                                            Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-orange-600 transition-all font-medium appearance-none">
                                            <option value="L" class="bg-slate-800"
                                                {{ $petugas->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" class="bg-slate-800"
                                                {{ $petugas->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-orange-400 text-xs font-black uppercase tracking-widest ml-1">Nomor
                                        Induk</label>
                                    <input type="number" name="nomor_induk" value="{{ $petugas->nomor_induk }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-orange-600 focus:bg-white/10 transition-all font-medium">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-orange-400 text-xs font-black uppercase tracking-widest ml-1">Alamat
                                        Lengkap</label>
                                    <textarea name="alamat" rows="4"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-orange-600 focus:bg-white/10 transition-all font-medium resize-none">{{ $petugas->alamat }}</textarea>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full bg-orange-600 hover:bg-orange-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-orange-900/20 flex items-center justify-center space-x-3 group">
                                        <span>SIMPAN PERUBAHAN</span>
                                        <i
                                            class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-center space-x-4 text-slate-400">
                            <div class="h-[1px] w-12 bg-orange-200"></div>
                            <p class="text-[10px] font-bold uppercase tracking-tighter italic">Data Anda terenkripsi dengan
                                aman dalam sistem</p>
                            <div class="h-[1px] w-12 bg-orange-200"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Smooth transition for inputs */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) sepia(100%) saturate(1000%) hue-rotate(0deg);
            cursor: pointer;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
