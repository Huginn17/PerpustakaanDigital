@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-6 sm:ml-64 bg-[#fafafa] min-h-screen">

        {{-- Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tighter">
                    Input <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-400">Pengguna</span>
                </h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Daftarkan personel baru ke dalam ekosistem digital.</p>
            </div>

            <a href="{{ route('kepala.pengguna.index') }}"
                class="group flex items-center text-slate-400 hover:text-slate-900 transition-all font-bold text-xs uppercase tracking-widest">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Error Validation Style --}}
        @if ($errors->any())
            <div
                class="mb-8 p-5 bg-white border-l-4 border-orange-500 rounded-2xl shadow-[0_10px_30px_rgba(249,115,22,0.1)]">
                <div class="flex items-center mb-3 text-orange-600 font-black uppercase text-[10px] tracking-[0.2em]">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Terjadi Kesalahan Input
                </div>
                <ul
                    class="grid grid-cols-1 md:grid-cols-2 gap-x-6 text-slate-600 text-xs font-bold space-y-1 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div
            class="relative bg-white rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] border border-slate-100 p-8 md:p-14 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-orange-100/40 rounded-full blur-[100px]"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-slate-100 rounded-full blur-[100px]"></div>

            <form action="{{ route('kepala.pengguna.store') }}" method="POST" class="relative z-10">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Kolom Kiri: Account Security --}}
                    <div class="lg:col-span-5 space-y-8">
                        <div>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Username</label>
                                    <input type="text" name="username" placeholder="Masukkan username..."
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm placeholder:text-slate-300"
                                        value="{{ old('username') }}">
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email
                                        Address</label>
                                    <input type="email" name="email" placeholder="contoh@galaxy.com"
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm placeholder:text-slate-300"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                                    <input type="password" name="password" placeholder="••••••••"
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm placeholder:text-slate-300">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Role
                                        Access</label>
                                    <div class="relative">
                                        <select name="role"
                                            class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm appearance-none cursor-pointer">
                                            <option value="" disabled selected>Pilih Otoritas</option>
                                            <option value="anggota">Anggota</option>
                                            <option value="petugas">Petugas</option>
                                            <option value="kepala_perpustakaan">Kepala Perpustakaan</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Divider for Desktop --}}
                    <div class="hidden lg:block lg:col-span-1 border-r border-slate-100 h-full"></div>

                    {{-- Kolom Kanan: Personal Details --}}
                    <div class="lg:col-span-6 space-y-8">
                        <div>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Full
                                    Username</label>
                                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap sesuai identitas..."
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm placeholder:text-slate-300"
                                        value="{{ old('nama_lengkap') }}">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor Induk</label>
                                        <input type="number" name="nomor_induk" placeholder="NIS/NIP..."
                                            class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm placeholder:text-slate-300"
                                            value="{{ old('nomor_induk') }}">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Gender</label>
                                        <div class="relative">
                                            <select name="jenis_kelamin"
                                                class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm appearance-none cursor-pointer">
                                                <option value="" disabled selected>Pilih</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm"
                                        value="{{ old('tanggal_lahir') }}">
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat</label>
                                    <textarea name="alamat" rows="2" placeholder="Masukkan alamat domisili lengkap..."
                                        class="w-full px-7 py-4 bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-slate-700 shadow-sm resize-none placeholder:text-slate-300">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Footer --}}
                <div class="mt-16 pt-10 border-t border-slate-50 flex flex-col md:flex-row items-center justify-end gap-6">
                    <button type="reset"
                        class="text-slate-400 hover:text-red-500 font-black text-[10px] uppercase tracking-[0.3em] transition-colors">
                        Reset Form
                    </button>

                    <button type="submit"
                        class="group relative w-full md:w-auto px-12 py-5 bg-slate-900 text-white font-black uppercase tracking-widest rounded-[2rem] shadow-[0_20px_40px_rgba(0,0,0,0.1)] hover:shadow-orange-200 transition-all duration-500 hover:-translate-y-1 active:scale-95 overflow-hidden">
                        <div class="absolute inset-0 w-0 bg-orange-500 transition-all duration-500 group-hover:w-full">
                        </div>
                        <span class="relative z-10 flex items-center justify-center">
                            SIMPAN DATA PERSONEL
                            <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Modern Date Picker Reset */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(346deg) brightness(100%) contrast(97%);
            cursor: pointer;
            padding: 5px;
        }

        /* Smooth Transition for Select */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
@endsection
