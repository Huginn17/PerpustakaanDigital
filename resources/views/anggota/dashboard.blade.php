@extends('anggota.layout.index')
@section('anggota')
    <div class="p-10 sm:ml-64">
        {{-- <div class="min-h-screen bg-white py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">

                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-indigo-950">Hallo, {{ Auth::user()->username ?? Auth::user()->anggota->nama_lengkap }}!</h1>
                    <p class="text-slate-500 text-lg">selamat datang kembali di halaman <span
                            class="font-bold text-indigo-900">Daftar Buku</span>!</p>
                </div>

                <div class="relative mb-12 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-full bg-slate-50 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Cari berdasarkan judul buku, penulis...">
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($bukus as $buku)
                        <a href="{{ route('anggota.buku.detail', $buku->id) }}" class="group">
                            <div
                                class="relative overflow-hidden rounded-lg transition-transform duration-300 group-hover:-translate-y-2">
                                @if ($buku->cover_image)
                                    <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                        class="w-full aspect-[3/4] object-cover shadow-lg rounded-lg"
                                        alt="{{ $buku->judul_buku }}">
                                @else
                                    <div
                                        class="w-full aspect-[3/4] bg-slate-200 flex items-center justify-center rounded-lg">
                                        No Cover</div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <h3 class="text-lg font-bold text-indigo-950 leading-tight group-hover:text-indigo-600">
                                    {{ $buku->judul_buku }}</h3>
                                <p class="text-sm text-slate-500">Penulis: {{ $buku->penulis }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div> --}}

        {{-- STATS SECTION: VIVID ORANGE ENERGY --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            {{-- STATS: DIPINJAM --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border-2 border-orange-50 shadow-sm hover:shadow-orange-200/50 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-orange-500 group-hover:text-white transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M192,24H96A16,16,0,0,0,80,40V56H64A16,16,0,0,0,48,72V224a8,8,0,0,0,12.65,6.51L112,193.83l51.36,36.68A8,8,0,0,0,176,224V184.69l19.35,13.82A8,8,0,0,0,208,192V40A16,16,0,0,0,192,24ZM160,208.46l-43.36-31a8,8,0,0,0-9.3,0L64,208.45V72h96Zm32-32L176,165V72a16,16,0,0,0-16-16H96V40h96Z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-5xl font-black text-slate-700 tracking-tighter">{{ $totalDipinjam }}</h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-400 mt-2">Sedang Dipinjam</p>
                </div>
            </div>

            {{-- STATS: DIKEMBALIKAN (ORANGE TERANG DOMINANT) --}}
            <div class="bg-orange-500 p-8 rounded-[2.5rem] shadow-xl shadow-orange-200 relative overflow-hidden group">
                {{-- Shine Effect --}}
                <div
                    class="absolute -left-10 -top-10 w-40 h-40 bg-white opacity-20 rounded-full blur-3xl transition-transform group-hover:scale-150 duration-700">
                </div>

                <div class="relative z-10 flex flex-col items-center text-center text-white h-full justify-center">
                    <h2 class="text-6xl font-black tracking-tighter mb-1">{{ $totalKembali }}</h2>
                    <p class="text-xs font-black uppercase tracking-[0.3em] opacity-90">Berhasil Kembali</p>
                    <div class="mt-4 px-4 py-1 bg-white/20 rounded-full text-[9px] font-bold tracking-widest uppercase">
                        Target Achieved</div>
                </div>
            </div>

            {{-- STATS: TERLAMBAT --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border-2 border-orange-50 shadow-sm hover:shadow-red-100 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-red-500 group-hover:text-white transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-5xl font-black text-slate-700 tracking-tighter">{{ $totalTerlambat }}</h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-red-400 mt-2">Buku Terlambat</p>
                </div>
            </div>

            {{-- STATS: DENDA --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border-2 border-red-100 shadow-sm hover:shadow-red-200/50 transition-all duration-300 group">

                <div class="flex flex-col items-center text-center">

                    <div
                        class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-red-500 group-hover:text-white transition-all duration-500">

                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3v1m6-1a3 3 0 00-6 0m6 0v1a3 3 0 01-6 0v-1m6 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h2 class="text-3xl font-black text-red-500 tracking-tighter">
                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                    </h2>

                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-red-400 mt-2">
                        Total Denda
                    </p>

                    @if ($jumlahDendaBelumBayar > 0)
                        <span class="mt-2 text-[9px] bg-red-100 text-red-600 px-3 py-1 rounded-full font-bold">
                            {{ $jumlahDendaBelumBayar }} Belum Dibayar
                        </span>
                    @else
                        <span class="mt-2 text-[9px] bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold">
                            Lunas
                        </span>
                    @endif

                </div>
            </div>

        </div>

        {{-- TABLE SECTION: ORANGE ACCENTED CLEAN PANEL --}}
        <div class="bg-white rounded-[3rem] p-1 shadow-2xl shadow-slate-100 border border-orange-50">
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6">
                    <div class="text-center md:text-left">
                        <h2 class="text-4xl font-black text-slate-700 tracking-tight">Aktivitas <span
                                class="text-orange-500 italic">Buku</span></h2>
                        <div class="h-1.5 w-20 bg-orange-500 rounded-full mt-2 mx-auto md:mx-0"></div>
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse ($aktivitas as $item)
                        <div class="relative group">
                            <div
                                class="flex flex-col md:flex-row items-center justify-between p-7 bg-white border-2 border-slate-50 rounded-[2.5rem] group-hover:border-orange-400 transition-all duration-300 group-hover:shadow-xl group-hover:shadow-orange-100">

                                {{-- Book Branding --}}
                                <div class="flex items-center space-x-6 mb-4 md:mb-0">
                                    <div
                                        class="h-14 w-14 bg-orange-500 text-white rounded-[1.2rem] flex items-center justify-center font-black text-xl shadow-lg shadow-orange-200">
                                        {{ substr($item->buku->judul_buku ?? 'B', 0, 1) }}
                                    </div>
                                    <div>
                                        <h4
                                            class="text-slate-700 font-black text-lg group-hover:text-orange-600 transition-colors leading-tight">
                                            {{ $item->buku->judul_buku ?? '-' }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                            Sistem Perpustakaan Modern</p>
                                    </div>
                                </div>

                                {{-- Timeline --}}
                                <div class="flex space-x-10 mb-6 md:mb-0">
                                    <div class="text-center">
                                        <span
                                            class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Pinjam</span>
                                        <p class="text-sm font-bold text-slate-600">{{ $item->tanggal_pinjam }}</p>
                                    </div>
                                    <div class="text-center">
                                        <span
                                            class="text-[9px] font-black text-orange-400 uppercase tracking-tighter">Deadline</span>
                                        <p class="text-sm font-black text-orange-500 italic">
                                            {{ $item->tanggal_jatuh_tempo ?? '---' }}</p>
                                    </div>
                                </div>

                                {{-- Status Badge --}}
                                <div class="w-full md:w-auto text-right">
                                    @if ($item->status == 'dipinjam')
                                        <div
                                            class="inline-flex items-center bg-orange-50 text-orange-600 px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-orange-100">
                                            {{-- <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 animate-ping"></span> --}}
                                            Dipinjam
                                        </div>
                                    @elseif($item->status == 'dikembalikan')
                                        <div
                                            class="inline-flex items-center bg-slate-50 text-slate-400 px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-100">
                                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                                                </path>
                                            </svg>
                                            Selesai
                                        </div>
                                    @else
                                        <span
                                            class="text-slate-400 font-bold text-[10px] uppercase tracking-widest">{{ $item->status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center border-4 border-dashed border-orange-50 rounded-[3rem]">
                            <p class="text-orange-200 font-black uppercase tracking-[0.5em] text-sm italic">Data Kosong</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection
