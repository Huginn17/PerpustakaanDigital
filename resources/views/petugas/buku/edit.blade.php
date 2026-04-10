@extends('petugas.layout.index')
@section('petugas')
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Bricolage Grotesque', sans-serif;
        }
    </style>

    <div class="p-4 sm:ml-64 bg-[#fdfdfd] min-h-screen">
        <div class="max-w-5xl mx-auto py-10 px-4">

            <nav class="flex mb-8 text-xs font-black uppercase tracking-[0.2em]" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('buku.index') }}"
                            class="text-slate-400 hover:text-orange-600 transition-colors">Arsip Buku</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-orange-600">Modifikasi Data</li>
                </ol>
            </nav>

            <div
                class="bg-white rounded-[3rem] shadow-2xl shadow-orange-100/40 overflow-hidden border border-orange-50 flex flex-col md:flex-row">

                <div
                    class="md:w-2/5 bg-slate-900 p-10 text-white flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-32 h-32 bg-orange-500/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10 text-center">
                        <p class="text-orange-500 text-[10px] uppercase font-black tracking-[0.3em] mb-8">Preview Katalog
                        </p>

                        <div class="relative inline-block group">
                            @if ($buku->cover_image)
                                <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                    class="w-48 h-64 object-cover rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform -rotate-2 group-hover:rotate-0 transition-all duration-700 border-4 border-white/5">
                            @else
                                <div
                                    class="w-48 h-64 bg-slate-800 rounded-[2rem] border-2 border-dashed border-slate-700 flex flex-col items-center justify-center text-slate-500">
                                    <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="italic text-xs font-medium uppercase tracking-widest">No Cover Image</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-10">
                            <h3 class="text-2xl font-extrabold leading-tight tracking-tight">{{ $buku->judul_buku }}</h3>
                            <div class="inline-block h-1 w-12 bg-orange-500 my-4 rounded-full"></div>
                            <p class="text-slate-400 text-sm font-medium italic opacity-80">{{ $buku->penulis }}</p>
                        </div>
                    </div>
                </div>

                <div class="md:w-3/5 p-8 lg:p-14 bg-white">
                    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Kode Buku</label>
                                <input type="text" name="kode_buku" value="{{ $buku->kode_buku }}"
                                    class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-mono font-bold text-slate-700">
                            </div>

                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Stock </label>
                                <input type="number" name="stock_buku" value="{{ $buku->stock_buku }}"
                                    class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700">
                            </div>
                        </div>

                        <div class="group space-y-2">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Judul Buku</label>
                            <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"
                                class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-800 text-lg">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Penulis</label>
                                <input type="text" name="penulis" value="{{ $buku->penulis }}"
                                    class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700">
                            </div>

                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Tahun Terbit</label>
                                <input type="date" name="tahun_terbit" value="{{ $buku->tahun_terbit }}"
                                    class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-600">
                            </div>
                        </div>

                        <div class="group space-y-2">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Sinopsis Buku</label>
                            <textarea name="sinopsis" rows="3"
                                class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all resize-none text-sm leading-relaxed font-medium">{{ $buku->sinopsis }}</textarea>
                        </div>

                        <div class="group space-y-2">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 transition-colors group-focus-within:text-orange-500">Update
                                Cover Buku</label>
                            <input type="file" name="cover_image"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-orange-600 file:text-white hover:file:bg-slate-900 transition-all border-2 border-dashed border-slate-100 rounded-2xl p-1.5">
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit"
                                class="flex-1 py-4 bg-orange-600 hover:bg-orange-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-[1.5rem] shadow-xl  transition-all transform active:scale-95">
                                Simpan Perubahajn
                            </button>
                            <a href="{{ route('buku.index') }}"
                                class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-500 text-xs font-black uppercase tracking-[0.2em] rounded-[1.5rem] transition-all text-center">
                                Discard
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-8 text-center text-[10px] font-bold text-slate-300 uppercase tracking-[0.5em]">Inventory System
                v2.0</p>
        </div>
    </div>
@endsection
