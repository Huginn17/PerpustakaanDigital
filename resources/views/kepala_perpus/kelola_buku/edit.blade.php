@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-4 sm:ml-64 bg-orange-50/30 min-h-screen font-['Plus_Jakarta_Sans']">
        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">

                {{-- BREADCRUMB --}}
                <nav class="flex mb-8 text-sm font-bold" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li>
                            <a href="{{ route('kepala.buku.index') }}"
                                class="text-slate-400 hover:text-orange-600 transition-colors">Daftar Buku</a>
                        </li>
                        <li class="text-slate-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                                </path>
                            </svg>
                        </li>
                        <li
                            class="text-orange-600 tracking-wide uppercase text-[11px] bg-orange-100 px-3 py-1 rounded-full">
                            Mode Edit</li>
                    </ol>
                </nav>

                {{-- MAIN CARD --}}
                <div
                    class="bg-white rounded-[2.5rem] shadow-2xl shadow-orange-200/50 overflow-hidden border border-orange-50 flex flex-col lg:flex-row">

                    {{-- LEFT SIDE: PREVIEW COVER (Visual Branding) --}}
                    <div
                        class="lg:w-1/3 bg-slate-900 p-10 text-white flex flex-col items-center justify-center relative overflow-hidden">
                        <div class="absolute -top-20 -left-20 w-64 h-64 bg-orange-500/20 rounded-full blur-[80px]"></div>
                        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-amber-500/10 rounded-full blur-[80px]"></div>

                        <p class="relative z-10 text-orange-400 text-[10px] uppercase tracking-[0.3em] font-black mb-8">
                            Cover Preview</p>

                        <div class="relative z-10 group">
                            @if ($buku->cover_image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                        class="w-48 h-64 object-cover rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform -rotate-2 group-hover:rotate-0 transition-all duration-700 border-2 border-white/20">
                                    <div
                                        class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-48 h-64 bg-slate-800 rounded-2xl border-2 border-dashed border-slate-700 flex flex-col items-center justify-center text-slate-500 space-y-3">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-xs italic font-medium">No Image Uploaded</span>
                                </div>
                            @endif
                        </div>

                        <div class="relative z-10 mt-10 text-center">
                            <h3 class="font-extrabold text-xl leading-tight text-white px-4">{{ $buku->judul_buku }}</h3>
                            <div
                                class="inline-block mt-3 px-4 py-1 bg-orange-500/20 rounded-full border border-orange-500/30">
                                <p class="text-orange-400 text-xs font-bold">{{ $buku->penulis }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE: FORM --}}
                    <div class="lg:w-2/3 p-8 lg:p-14 bg-white relative">
                        <div class="mb-10">
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Perbarui <span
                                    class="text-orange-500">Informasi</span></h2>
                            <p class="text-slate-400 text-sm mt-1 font-medium">Lakukan perubahan pada data buku di bawah
                                ini.</p>
                        </div>

                        <form action="{{ route('kepala.buku.update', $buku->id) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-7">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- KODE BUKU --}}
                                <div class="group space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Identitas
                                        Buku</label>
                                    <input type="text" name="kode_buku" value="{{ $buku->kode_buku }}"
                                        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-mono font-bold text-slate-700 shadow-sm">
                                </div>

                                {{-- STOK --}}
                                <div class="group space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Jumlah
                                        Unit</label>
                                    <input type="number" name="stock_buku" value="{{ $buku->stock_buku }}"
                                        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700 shadow-sm">
                                </div>
                            </div>

                            {{-- JUDUL --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Judul
                                    Lengkap</label>
                                <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700 shadow-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- PENULIS --}}
                                <div class="group space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Nama
                                        Penulis</label>
                                    <input type="text" name="penulis" value="{{ $buku->penulis }}"
                                        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700 shadow-sm">
                                </div>

                                {{-- TAHUN --}}
                                <div class="group space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Tahun
                                        Terbit</label>
                                    <input type="date" name="tahun_terbit" value="{{ $buku->tahun_terbit }}"
                                        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-600 shadow-sm">
                                </div>
                            </div>

                            {{-- SINOPSIS --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-orange-500 transition-colors">Sinopsis
                                    Koleksi</label>
                                <textarea name="sinopsis" rows="4"
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all resize-none font-medium text-slate-600 leading-relaxed shadow-sm">{{ $buku->sinopsis }}</textarea>
                            </div>

                            {{-- FILE UPLOAD --}}
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ganti
                                    Cover (Opsional)</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-0 bg-orange-50 rounded-2xl border-2 border-dashed border-orange-200 group-hover:border-orange-400 transition-all">
                                    </div>
                                    <input type="file" name="cover_image"
                                        class="relative block w-full text-sm text-slate-500 file:mr-6 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-orange-500 file:text-white hover:file:bg-orange-600 transition-all p-2 cursor-pointer">
                                </div>
                            </div>

                            {{-- ACTIONS --}}
                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                <button type="submit"
                                    class="flex-1 py-4 bg-gradient-to-r from-orange-500 to-amber-600 text-white font-black rounded-[1.25rem] shadow-xl shadow-orange-200 hover:shadow-orange-300 hover:scale-[1.02] active:scale-95 transition-all">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('kepala.buku.index') }}"
                                    class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-500 font-bold rounded-[1.25rem] transition-all text-center">
                                    Batalkan
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
