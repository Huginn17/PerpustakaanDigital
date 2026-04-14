@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-4 sm:ml-64 bg-orange-50/30 min-h-screen font-['Plus_Jakarta_Sans']">
        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">

                {{-- BACK BUTTON --}}
                <div class="mb-8">
                    <a href="{{ route('kepala.buku.index') }}"
                        class="group inline-flex items-center text-sm font-bold text-orange-600 hover:text-orange-700 transition-all">
                        <div
                            class="bg-white p-2 rounded-lg shadow-sm border border-orange-100 group-hover:shadow-md group-hover:-translate-x-1 transition-all mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </div>
                        Kembali ke Koleksi
                    </a>
                </div>

                {{-- MAIN CARD --}}
                <div
                    class="bg-white rounded-[2.5rem] shadow-2xl shadow-orange-200/50 overflow-hidden border border-orange-50">

                    {{-- HEADER --}}
                    <div class="relative bg-gradient-to-br from-orange-500 to-amber-600 px-10 py-10 overflow-hidden">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                        <div
                            class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-orange-400/20 rounded-full blur-2xl">
                        </div>

                        <div class="relative flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-extrabold text-white tracking-tight">Tambah Koleksi <span
                                        class="text-orange-100 italic">Baru</span></h2>
                                <p class="text-orange-100/80 text-sm mt-2 font-medium tracking-wide">Lengkapi arsip
                                    perpustakaan dengan data yang akurat.</p>
                            </div>
                            <div
                                class="hidden sm:block bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <form action="{{ route('kepala.buku.store') }}" method="POST" enctype="multipart/form-data"
                        class="p-10 space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- KODE BUKU --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Kode
                                    Unik Buku</label>
                                <div class="relative">
                                    <input type="text" name="kode_buku" placeholder="Contoh: BKN-001"
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all placeholder:text-slate-300 font-bold text-slate-700">
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- JUMLAH STOK --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Ketersediaan
                                    Stok</label>
                                <div class="relative">
                                    <input type="number" name="stock_buku" placeholder="0"
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700">
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- JUDUL BUKU --}}
                        <div class="group space-y-2">
                            <label
                                class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Judul
                                Utama Buku</label>
                            <input type="text" name="judul_buku" placeholder="Masukkan judul lengkap"
                                class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- PENULIS --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Nama
                                    Penulis</label>
                                <input type="text" name="penulis" placeholder="Siapa penulisnya?"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-700">
                            </div>

                            {{-- TAHUN TERBIT --}}
                            <div class="group space-y-2">
                                <label
                                    class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Tanggal
                                    Terbit</label>
                                <input type="date" name="tahun_terbit"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-600">
                            </div>
                        </div>

                        {{-- SINOPSIS --}}
                        <div class="group space-y-2">
                            <label
                                class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1 group-focus-within:text-orange-500 transition-colors">Sinopsis
                                Singkat</label>
                            <textarea name="sinopsis" rows="4" placeholder="Berikan deskripsi singkat tentang isi buku ini..."
                                class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all resize-none font-medium text-slate-700 leading-relaxed"></textarea>
                        </div>

                        {{-- COVER IMAGE --}}
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-[0.15em] ml-1">Unggah Cover
                                Buku</label>
                            <div class="relative group cursor-pointer">
                                <div
                                    class="absolute inset-0 bg-orange-100/50 rounded-2xl border-2 border-dashed border-orange-200 group-hover:border-orange-400 transition-all">
                                </div>
                                <input type="file" name="cover_image"
                                    class="relative block w-full text-sm text-slate-500 file:mr-6 file:py-4 file:px-8 file:rounded-2xl file:border-0 file:text-sm file:font-black file:bg-orange-500 file:text-white hover:file:bg-orange-600 transition-all p-3 cursor-pointer">
                            </div>
                            <p class="text-[10px] text-slate-400 italic px-2">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full py-5 bg-gradient-to-r from-orange-500 via-orange-600 to-amber-600 text-white font-black text-lg rounded-[1.5rem] shadow-xl shadow-orange-200 hover:shadow-orange-300 hover:scale-[1.01] transition-all transform active:scale-[0.97]">
                                Simpan Koleksi Sekarang
                            </button>
                            <div class="flex items-center justify-center space-x-2 mt-6">
                                <span class="h-1 w-1 bg-slate-300 rounded-full"></span>
                                <span class="h-1 w-1 bg-slate-300 rounded-full"></span>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mx-2">Verifikasi
                                    Data Sebelum Klik</p>
                                <span class="h-1 w-1 bg-slate-300 rounded-full"></span>
                                <span class="h-1 w-1 bg-slate-300 rounded-full"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
