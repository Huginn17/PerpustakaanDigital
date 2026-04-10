@extends('anggota.layout.index')
@section('anggota')
    <div class="p-4 sm:ml-64">
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

        <h1>Dashboard Anggota</h1>
    </div>
@endsection
