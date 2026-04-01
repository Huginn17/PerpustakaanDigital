@extends('anggota.layout.index')
@section('anggota')
    <div class="p-4 sm:ml-64">
        <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">

                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        📚 Daftar Koleksi Perpustakaan
                    </h2>
                    <p class="mt-2 text-slate-600">Temukan dan pinjam buku favoritmu dengan mudah.</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 shadow-sm rounded-r-lg"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20 text-emerald-500">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 shadow-sm rounded-r-lg"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="bg-white shadow-xl shadow-slate-200/60 rounded-2xl overflow-hidden border border-slate-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 border-bottom border-slate-100">
                                    Cover</th>
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 border-bottom border-slate-100">
                                    Detail Buku</th>
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 border-bottom border-slate-100">
                                    Penulis</th>
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 border-bottom border-slate-100 text-center">
                                    Status Stok</th>
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 border-bottom border-slate-100 text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($bukus as $buku)
                                <tr class="hover:bg-slate-50/80 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        @if ($buku->cover_image)
                                            <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                                class="w-16 h-24 object-cover rounded-lg shadow-md ring-1 ring-slate-200"
                                                alt="Cover {{ $buku->judul_buku }}">
                                        @else
                                            <div
                                                class="w-16 h-24 bg-slate-100 rounded-lg flex items-center justify-center border-2 border-dashed border-slate-200 text-slate-400 text-[10px] text-center px-1">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-slate-800">{{ $buku->judul_buku }}</div>
                                        <div
                                            class="text-xs text-indigo-500 font-mono mt-1 font-medium bg-indigo-50 inline-block px-2 py-0.5 rounded">
                                            {{ $buku->kode_buku }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-slate-600 italic">{{ $buku->penulis }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($buku->stock_buku > 0)
                                            <span
                                                class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                                {{ $buku->stock_buku }} Unit
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-600">
                                                Stok Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if ($buku->stock_buku > 0)
                                            <form action="{{ route('pinjam.buku') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all active:scale-95">
                                                    Pinjam
                                                </button>
                                            </form>
                                        @else
                                            <button disabled
                                                class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-lg text-slate-400 bg-slate-100 cursor-not-allowed">
                                                Kosong
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-center text-slate-400 text-sm">
                    &copy; 2026 Library System &bull; Crafted with Umbrella Corporation
                </div>
            </div>
        </div>
    </div>
@endsection
