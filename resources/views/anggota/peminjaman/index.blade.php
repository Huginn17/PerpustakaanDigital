@extends('anggota.layout.index')

@section('anggota')
    <div class="p-10 sm:ml-80 bg-[#fcfcfd] min-h-screen">
        <div class="max-w-7xl mx-auto py-10">

            <div class="relative mb-16 px-4">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-orange-200/30 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h1 class="text-5xl font-extrabold text-slate-900 tracking-tighter">
                        Halo, <span class="text-orange-500">{{ Auth::user()->username ?? 'Pembaca' }}</span>
                    </h1>
                    <p class="text-slate-400 mt-3 text-xl font-medium">Temukan inspirasi baru di rak buku digital hari ini.
                    </p>
                </div>

                <div class="mt-10 max-w-2xl">
                    <form method="GET" action="{{ url()->current() }}" class="mb-4">
                        <div
                            class="flex items-center bg-white border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-[2rem] p-2 pr-4 focus-within:ring-2 focus-within:ring-orange-400 transition-all">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Cari judul, penulis, atau kode buku..."
                                class="flex-grow bg-transparent border-none focus:ring-0 px-6 py-3 text-slate-600 placeholder:text-slate-300 font-medium">
                            <button
                                class="bg-orange-500 hover:bg-slate-900 text-white p-3 rounded-[1.5rem] transition-all shadow-lg shadow-orange-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-12">
                @foreach ($bukus as $buku)
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-white rounded-[2.5rem] shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-slate-100 group-hover:border-orange-200 group-hover:shadow-orange-100/50 transition-all duration-500">
                        </div>

                        <div class="relative p-5">
                            <div
                                class="relative -mt-12 mb-6 group-hover:-translate-y-4 transition-transform duration-500 ease-out">
                                <a href="{{ route('anggota.buku.detail', $buku->id) }}">
                                    @if ($buku->cover_image)
                                        <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                            class="w-full aspect-[3/4.5] object-cover rounded-[2rem] shadow-2xl shadow-slate-400 group-hover:shadow-orange-400/40 transition-all duration-500"
                                            alt="{{ $buku->judul_buku }}">
                                    @else
                                        <div
                                            class="w-full aspect-[3/4.5] bg-slate-100 rounded-[2rem] flex items-center justify-center border-2 border-dashed border-slate-200">
                                            <span class="text-slate-300 font-bold uppercase tracking-tighter">No
                                                Cover</span>
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <div class="text-center px-2">
                                <h3
                                    class="text-lg font-black text-slate-800 leading-tight line-clamp-2 group-hover:text-orange-500 transition-colors">
                                    {{ $buku->judul_buku }}
                                </h3>
                                <p class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest italic">
                                    {{ $buku->penulis }}
                                </p>

                                <div
                                    class="mt-6 flex justify-center opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0">
                                    <a href="{{ route('anggota.buku.detail', $buku->id) }}"
                                        class="text-xs font-black text-orange-500 flex items-center gap-2 group/link">
                                        LIHAT DETAIL
                                        <span class="w-6 h-[2px] bg-orange-500 group-hover/link:w-10 transition-all"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $bukus->links() }}

        </div>
    </div>

    <style>
        /* Mengatasi judul yang terlalu panjang agar rapi */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
