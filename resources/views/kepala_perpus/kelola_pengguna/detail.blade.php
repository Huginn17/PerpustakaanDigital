@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-6 sm:ml-64 min-h-screen bg-[#fafafa] font-['Plus_Jakarta_Sans']">
        @php
            $relasiMap = [
                'anggota' => $user->anggota,
                'petugas' => $user->petugas,
                'kepala_perpustakaan' => $user->kepala_perpustakaan,
            ];
            $relasi = $relasiMap[$user->role] ?? null;
        @endphp

        <div class="max-w-4xl mx-auto mt-6">

            {{-- Breadcrumb / Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Profil <span
                            class="text-orange-500">Personel</span></h1>
                    <p class="text-slate-500 text-sm font-medium">Informasi mendetail mengenai entitas pengguna.</p>
                </div>
                <a href="{{ route('kepala.pengguna.index') }}"
                    class="group flex items-center text-slate-400 hover:text-slate-900 transition-all font-bold text-xs uppercase tracking-widest">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Daftar Pengguna
                </a>
            </div>

            {{-- PROFILE HEADER CARD --}}
            <div
                class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-10 shadow-[0_30px_60px_rgba(0,0,0,0.15)] mb-8">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-orange-500/20 rounded-full blur-[80px]"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-orange-600/10 rounded-full blur-[80px]"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="relative">
                        <div class="absolute inset-0 bg-orange-500 rounded-full blur-xl opacity-30 animate-pulse"></div>
                        <div
                            class="relative w-32 h-32 rounded-full bg-gradient-to-tr from-orange-500 to-amber-300 flex items-center justify-center text-5xl font-black text-white border-4 border-slate-800 shadow-2xl">
                            {{ strtoupper(substr($user->username, 0, 1)) }}
                        </div>
                    </div>

                    <div class="text-center md:text-left">
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-500 text-[10px] font-black uppercase tracking-[0.2em] mb-3">
                            {{ str_replace('_', ' ', $user->role) }}
                        </div>
                        <h2 class="text-4xl font-black text-white tracking-tight mb-1">
                            {{ $relasi->nama_lengkap ?? $user->username }}</h2>
                        <p
                            class="text-slate-400 font-medium flex items-center justify-center md:justify-start gap-2 italic">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- INFO GRID --}}
            <div class="grid md:grid-cols-3 gap-6">

                {{-- Left: Credentials --}}
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Account Security</p>

                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-bold text-orange-500 block">Username</label>
                                <p class="text-slate-700 font-bold tracking-tight">{{ $user->username }}</p>
                            </div>
                            <hr class="border-slate-50">
                            <div>
                                <label class="text-[10px] font-bold text-orange-500 block">System Access</label>
                                <p class="text-slate-700 font-bold tracking-tight capitalize">
                                    {{ str_replace('_', ' ', $user->role) }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('kepala.pengguna.edit', $user->id) }}"
                        class="flex items-center justify-center gap-3 w-full py-5 bg-orange-500 hover:bg-orange-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-lg shadow-orange-100 transition-all hover:-translate-y-1 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profil
                    </a>
                </div>

                {{-- Right: Personal Details --}}
                <div class="md:col-span-2">
                    <div
                        class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm h-full relative overflow-hidden">
                        <p
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                            Identitas Lengkap
                        </p>

                        @if ($relasi)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Full
                                        Name</span>
                                    <p class="text-slate-800 font-extrabold text-lg">{{ $relasi->nama_lengkap }}</p>
                                </div>

                                <div class="space-y-1">
                                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">ID
                                        Number</span>
                                    <p class="text-slate-800 font-extrabold text-lg tracking-wider">
                                        {{ $relasi->nomor_induk }}</p>
                                </div>

                                <div class="space-y-1 border-t border-slate-50 pt-4">
                                    <span
                                        class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Gender</span>
                                    <p class="text-slate-800 font-extrabold">
                                        {{ $relasi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>

                                <div class="space-y-1 border-t border-slate-50 pt-4">
                                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Date of
                                        Birth</span>
                                    <p class="text-slate-800 font-extrabold">
                                        {{ \Carbon\Carbon::parse($relasi->tanggal_lahir)->format('d F Y') }}</p>
                                </div>

                                <div class="col-span-1 sm:col-span-2 space-y-1 border-t border-slate-50 pt-4">
                                    <span
                                        class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Residential
                                        Address</span>
                                    <p class="text-slate-800 font-extrabold leading-relaxed">{{ $relasi->alamat }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <div
                                    class="w-16 h-16 bg-red-50 text-red-400 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <p class="text-slate-400 font-bold tracking-tight italic">Data profil belum dikaitkan /
                                    tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
