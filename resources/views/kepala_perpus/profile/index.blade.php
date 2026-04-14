@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-6 sm:ml-64 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
        <div class="max-w-4xl mx-auto mt-4">

            {{-- Header Page --}}
            <div class="mb-10 flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="h-14 w-2 bg-orange-500 rounded-full shadow-[0_0_15px_rgba(249,115,22,0.4)]"></div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Profil <span
                                class="text-orange-500">Pimpinan</span></h1>
                        <p class="text-slate-500 text-sm font-medium">Otoritas manajemen tingkat tertinggi perpustakaan.</p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">Administrator
                        Access</span>
                </div>
            </div>

            <div
                class="relative bg-white rounded-[3rem] shadow-[0_40px_80px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden">

                {{-- Decorative Background Elements --}}
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-orange-100/40 rounded-full blur-[100px]"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-slate-100 rounded-full blur-[100px]"></div>

                {{-- Notification --}}
                @if (session('success'))
                    <div
                        class="mx-10 mt-10 bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-2xl animate-fade-in-down relative z-10">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3 font-bold text-orange-800 text-sm">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('profile.update.kepala') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 md:p-12 relative z-10">
                    @csrf

                    <div class="flex flex-col lg:flex-row gap-14">

                        {{-- LEFT SIDE: PROFILE PHOTO --}}
                        <div class="lg:w-1/3 flex flex-col items-center">
                            <div class="relative group">


                                <div class="relative">
                                    @if ($kepala->foto_profil)
                                        <img src="{{ asset('storage/' . $kepala->foto_profil) }}"
                                            class="relative w-52 h-52 rounded-full object-cover border-[6px] border-white shadow-2xl transition-transform duration-500 group-hover:scale-[1.02]">
                                    @else
                                        <div
                                            class="relative w-52 h-52 rounded-full bg-slate-50 border-[6px] border-white flex items-center justify-center shadow-2xl">
                                            <svg class="w-24 h-24 text-slate-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif

                                    <label
                                        class="absolute bottom-2 right-2 bg-slate-900 text-white p-3.5 rounded-2xl cursor-pointer hover:bg-orange-500 shadow-xl transition-all border-4 border-white transform hover:scale-110 active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        </svg>
                                        <input type="file" name="foto_profil" class="hidden">
                                    </label>
                                </div>
                            </div>

                            <div class="mt-8 text-center">
                                <div
                                    class="px-5 py-2 bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full">
                                    Kepala Perpustakaan
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT SIDE: INPUT DATA --}}
                        <div class="lg:w-2/3 space-y-8">

                            {{-- NAME --}}
                            <div class="space-y-2 group">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Nama
                                    Lengkap Pimpinan</label>
                                <input type="text" name="nama_lengkap" value="{{ $kepala->nama_lengkap }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white transition-all outline-none font-bold text-slate-700 shadow-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- NOMOR INDUK --}}
                                <div class="space-y-2 group">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">NIP
                                        / Nomor Induk</label>
                                    <input type="text" name="nomor_induk" value="{{ $kepala->nomor_induk }}"
                                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white transition-all outline-none font-bold text-slate-700 shadow-sm">
                                </div>

                                {{-- JK --}}
                                <div class="space-y-2 group">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Gender</label>
                                    <div class="relative">
                                        <select name="jenis_kelamin"
                                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white transition-all outline-none font-bold text-slate-700 appearance-none cursor-pointer shadow-sm">
                                            <option value="">Pilih Gender</option>
                                            <option value="L" {{ $kepala->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ $kepala->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TANGGAL LAHIR --}}
                            <div class="space-y-2 group">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Tanggal
                                    Kelahiran</label>
                                <input type="date" name="tanggal_lahir" value="{{ $kepala->tanggal_lahir }}"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white transition-all outline-none font-bold text-slate-700 shadow-sm">
                            </div>

                            {{-- ALAMAT --}}
                            <div class="space-y-2 group">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Alamat
                                    Korespondensi</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white transition-all outline-none font-bold text-slate-700 resize-none shadow-sm">{{ $kepala->alamat }}</textarea>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="pt-6">
                                <button type="submit"
                                    class="group relative w-full bg-slate-900 text-white font-black py-5 rounded-[2rem] shadow-xl  transition-all duration-500 hover:-translate-y-1 overflow-hidden">
                                    {{-- <div
                                        class="absolute inset-0 w-0 bg-orange-500 transition-all duration-500 group-hover:w-full">
                                    </div> --}}
                                    <div
                                        class="relative z-10 flex items-center justify-center space-x-3 uppercase tracking-widest text-xs">
                                        <span>Sinkronisasi Data Profil</span>
                                        <svg class="w-5 h-5 transform group-hover:rotate-12 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(346deg) brightness(100%) contrast(97%);
            cursor: pointer;
        }
    </style>
@endsection
