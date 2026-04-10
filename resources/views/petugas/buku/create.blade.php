@extends('petugas.layout.index')
@section('petugas')
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;600;800&display=swap" rel="stylesheet">


    <div class="p-4 sm:ml-64 bg-[#fdfdfd] min-h-screen">
        <div class="max-w-4xl mx-auto py-10 px-4">

            <div class="mb-8">
                <a href="{{ route('buku.index') }}"
                    class="group inline-flex items-center text-sm font-bold text-slate-400 hover:text-orange-600 transition-all">
                    <div class="p-2 rounded-xl group-hover:bg-orange-50 mr-3 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </div>
                    Kembali ke Inventaris
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-orange-100/50 border border-orange-50 overflow-hidden">
                <div class="relative bg-gradient-to-r from-orange-500 to-amber-500 px-8 py-10 overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-3xl font-extrabold text-white tracking-tight">Tambah Koleksi Buku</h2>
                        <p class="text-orange-100 font-medium mt-2 opacity-90">Daftarkan judul buku baru ke dalam sistem
                            arsip digital.</p>
                    </div>
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                </div>

                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 md:p-12 space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Kode
                                Buku</label>
                            <input type="text" name="kode_buku" required placeholder="Contoh: BKN-001"
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold placeholder:text-slate-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Stock
                                Buku</label>
                            <input type="number" name="stock_buku" required placeholder="0"
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Judul Buku</label>
                        <input type="text" name="judul_buku" required placeholder="Masukkan judul lengkap buku..."
                            class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Penulis</label>
                            <input type="text" name="penulis" required placeholder="Nama penulis"
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Tahun Terbit</label>
                            <input type="date" name="tahun_terbit" required
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all font-bold text-slate-600">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Sinopsis Buku</label>
                        <textarea name="sinopsis" rows="4" placeholder="Gambarkan secara singkat isi buku ini..."
                            class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all resize-none font-medium leading-relaxed"></textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Cover Buku</label>
                        <div class="relative group">
                            <input type="file" name="cover_image"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-orange-600 file:text-white hover:file:bg-orange-700 transition-all border-2 border-dashed border-slate-200 hover:border-orange-300 rounded-2xl p-2 bg-slate-50/50">
                        </div>
                        <p class="text-[10px] text-slate-400 italic mt-1 ml-1">*Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                            class="w-full py-5 bg-slate-900 text-white text-sm font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-slate-200 hover:bg-orange-600 hover:shadow-orange-200 transition-all transform active:scale-[0.98]">
                            Simpan Koleksi Baru
                        </button>
                        <div class="flex items-center justify-center mt-6 gap-2">
                            <div class="h-1 w-1 bg-orange-400 rounded-full"></div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Data akan
                                langsung tersinkronisasi dengan katalog</p>
                            <div class="h-1 w-1 bg-orange-400 rounded-full"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
