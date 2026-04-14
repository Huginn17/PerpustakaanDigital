@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Hapus max-w-7xl dan ganti p-6 menjadi px-4 atau px-8 untuk kesan memanjang --}}
    <div class="p-2 sm:ml-64 min-h-screen bg-orange-50/50 p-4 lg:p-8 transition-all">
        <div class="w-full"> {{-- Menggunakan w-full alih-alih max-w-7xl --}}

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 px-2">
                <div class="space-y-1">
                    <div class="inline-flex items-center space-x-2 bg-orange-100 px-3 py-1 rounded-full">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-orange-600">Inventory
                            System</span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                        Manajemen <span class="text-orange-500 italic">Buku</span>
                    </h2>
                    <p class="text-slate-500 font-medium text-sm">Pantau dan kelola seluruh koleksi buku perpustakaan dalam
                        satu panel luas.</p>
                </div>

                <a href="{{ route('kepala.buku.create') }}"
                    class="group inline-flex items-center justify-center px-6 py-3.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-2xl shadow-lg shadow-orange-200 transition-all duration-300 active:scale-95">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Koleksi Baru
                </a>
            </div>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="mb-6 flex items-center p-4 bg-white border-l-4 border-orange-500 rounded-xl shadow-sm">
                    <div class="flex-shrink-0 bg-orange-100 p-2 rounded-lg text-orange-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4 text-slate-700 font-bold text-sm">{{ session('success') }}</div>
                </div>
            @endif

            {{-- TABLE CARD - FULL WIDTH --}}
            <div
                class="bg-white/70 backdrop-blur-xl rounded-[1.5rem] shadow-xl shadow-orange-200/30 overflow-hidden border border-white w-full">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-0 table-auto">
                        <thead>
                            <tr class="bg-orange-500/5">
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] border-b border-orange-100 w-32">
                                    Kode</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] border-b border-orange-100 w-1/4">
                                    Info Buku</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] border-b border-orange-100">
                                    Sinopsis</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] border-b border-orange-100 text-center w-24">
                                    Stok</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] border-b border-orange-100 text-right w-40">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-orange-50">
                            @foreach ($buku as $b)
                                <tr class="group hover:bg-orange-50/60 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-block bg-white text-orange-600 px-3 py-1 rounded-lg font-mono text-xs font-bold border border-orange-100 shadow-sm group-hover:border-orange-500 transition-all">
                                            {{ $b->kode_buku }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="font-bold text-slate-700 text-base leading-tight group-hover:text-orange-500 transition-colors">
                                            {{ $b->judul_buku }}
                                        </div>
                                        <div class="text-[11px] font-semibold text-slate-400 mt-0.5 tracking-wide italic">
                                            {{ $b->penulis }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p
                                            class="text-sm text-slate-500 line-clamp-1 group-hover:line-clamp-none transition-all duration-500 max-w-2xl leading-relaxed">
                                            {{ $b->sinopsis }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="text-base font-black {{ $b->stock_buku < 5 ? 'text-red-500' : 'text-slate-600' }}">
                                            {{ $b->stock_buku }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            <a href="{{ route('kepala.buku.edit', $b->id) }}"
                                                class="p-2 bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white rounded-xl transition-all"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('kepala.buku.destroy', $b->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                                    class="p-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER STATS --}}
                <div class="px-8 py-4 bg-orange-50/30 border-t border-orange-100 flex justify-between items-center">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Dashboard View &bull; Wide
                        Mode</span>
                    <div class="flex items-center space-x-3">
                        <span class="text-xs font-bold text-slate-500">Total Database:</span>
                        <span class="bg-orange-500 text-white px-4 py-1 rounded-lg text-xs font-black shadow-md">
                            {{ count($buku) }} Judul Buku
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
