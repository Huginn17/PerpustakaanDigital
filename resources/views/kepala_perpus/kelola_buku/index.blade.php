@extends('kepala_perpus.layout.index')
@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    <div class="p-4 sm:ml-64">
        <div class="min-h-screen bg-[#f3f4f9] p-6 lg:p-12">
            <div class="max-w-7xl mx-auto">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Data Buku</h2>
                        <p class="text-slate-500 mt-1">Kelola katalog perpustakaan Anda dengan cepat dan efisien.</p>
                    </div>

                    <a href="{{ route('kepala.buku.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Buku Baru
                    </a>
                </div>

                @if (session('success'))
                    <div
                        class="mb-8 flex items-center p-4 bg-emerald-50 border border-emerald-100 rounded-2xl shadow-sm animate-bounce-short">
                        <div class="flex-shrink-0 bg-emerald-500 p-2 rounded-lg text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3 text-emerald-800 font-semibold text-sm">{{ session('success') }}</div>
                    </div>
                @endif

                <div
                    class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th
                                        class="px-6 py-5 text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        Kode</th>
                                    <th
                                        class="px-6 py-5 text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        Info Buku</th>
                                    <th
                                        class="px-6 py-5 text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        Sinopsis</th>
                                    <th
                                        class="px-6 py-5 text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 text-center">
                                        Stok</th>
                                    <th
                                        class="px-6 py-5 text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 text-right">
                                        Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach ($buku as $b)
                                    <tr class="hover:bg-blue-50/30 transition-all group">
                                        <td class="px-6 py-4">
                                            <span
                                                class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg font-mono text-sm font-bold group-hover:bg-white transition-colors border border-slate-200">
                                                {{ $b->kode_buku }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div
                                                class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                                {{ $b->judul_buku }}</div>
                                            <div class="text-xs text-slate-400 font-medium">Oleh: {{ $b->penulis }}</div>
                                        </td>
                                        <td class="px-6 py-4 max-w-xs">
                                            <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed italic">
                                                "{{ $b->sinopsis }}"
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="inline-flex flex-col items-center">
                                                <span
                                                    class="text-lg font-bold {{ $b->stock_buku < 5 ? 'text-rose-500' : 'text-slate-700' }}">
                                                    {{ $b->stock_buku }}
                                                </span>
                                                <span
                                                    {{-- class="text-[10px] uppercase font-bold tracking-tighter text-slate-400">Eksmplr</span> --}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <a href="{{ route('kepala.buku.edit', $b->id) }}"
                                                    class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-xl transition-all shadow-sm"
                                                    title="Edit Data">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <form action="{{ route('kepala.buku.destroy', $b->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus buku ini?')"
                                                        class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm"
                                                        title="Hapus Buku">
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

                    <div class="px-6 py-4 bg-slate-50/50 text-center border-t border-slate-100">
                        <p class="text-xs text-slate-400 font-medium">Total Terdata: {{ count($buku) }} Buku</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection