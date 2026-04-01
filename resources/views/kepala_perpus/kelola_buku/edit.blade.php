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
        <div class="min-h-screen bg-[#f8fafc] flex items-center justify-center py-12 px-4">
            <div class="max-w-4xl w-full">

                <nav class="flex mb-8 text-sm font-medium text-slate-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li><a href="{{ route('buku.index') }}" class="hover:text-amber-600 transition-colors">Daftar Buku</a>
                        </li>
                        <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></li>
                        <li class="text-slate-800 font-bold">Edit Buku</li>
                    </ol>
                </nav>

                <div
                    class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 overflow-hidden border border-slate-100 flex flex-col md:flex-row">

                    <div class="md:w-1/3 bg-slate-900 p-8 text-white flex flex-col items-center justify-center text-center">
                        <p class="text-slate-400 text-xs uppercase tracking-widest font-bold mb-6">Cover Saat Ini</p>
                        <div class="relative group">
                            @if ($buku->cover_image)
                                <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                    class="w-40 h-56 object-cover rounded-2xl shadow-2xl rotate-2 group-hover:rotate-0 transition-transform duration-500 border-4 border-white/10">
                            @else
                                <div
                                    class="w-40 h-56 bg-slate-800 rounded-2xl border-2 border-dashed border-slate-700 flex items-center justify-center text-slate-500 italic text-sm">
                                    No Cover
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-8 font-bold text-lg leading-tight">{{ $buku->judul_buku }}</h3>
                        <p class="text-slate-400 text-sm mt-2 italic">{{ $buku->penulis }}</p>
                    </div>

                    <div class="md:w-2/3 p-8 lg:p-12 bg-white">
                        <form action="{{ route('kepala.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data"
                            class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase ml-1">Kode Buku</label>
                                    <input type="text" name="kode_buku" value="{{ $buku->kode_buku }}"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all font-mono">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase ml-1">Stok Unit</label>
                                    <input type="number" name="stock_buku" value="{{ $buku->stock_buku }}"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 uppercase ml-1">Judul Buku</label>
                                <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all font-semibold">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase ml-1">Penulis</label>
                                    <input type="text" name="penulis" value="{{ $buku->penulis }}"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase ml-1">Tahun Terbit</label>
                                    <input type="date" name="tahun_terbit" value="{{ $buku->tahun_terbit }}"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 uppercase ml-1">Sinopsis</label>
                                <textarea name="sinopsis" rows="4"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-amber-100 focus:border-amber-500 outline-none transition-all resize-none text-sm leading-relaxed">{{ $buku->sinopsis }}</textarea>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 uppercase ml-1">Ganti Cover
                                    (Opsional)</label>
                                <input type="file" name="cover_image"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all border border-slate-200 rounded-xl p-1">
                            </div>

                            <div class="flex gap-3 pt-4">
                                <button type="submit"
                                    class="flex-1 py-4 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl shadow-lg shadow-amber-200 transition-all transform active:scale-95">
                                    Perbarui Data
                                </button>
                                <a href="{{ route('kepala.buku.index') }}"
                                    class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all text-center">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
