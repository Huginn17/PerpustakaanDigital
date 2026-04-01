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
        <div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl w-full">

                <div class="mb-6">
                    <a href="{{ route('kepala.buku.index') }}"
                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Buku
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl shadow-indigo-100 overflow-hidden border border-slate-100">
                    <div class="bg-indigo-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">Tambah Koleksi Buku</h2>
                        <p class="text-indigo-100 text-sm mt-1">Lengkapi informasi di bawah untuk menambahkan buku baru ke
                            sistem.</p>
                    </div>

                    <form action="{{ route('kepala.buku.store') }}" method="POST" enctype="multipart/form-data"
                        class="p-8 space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 ml-1">Kode Buku</label>
                                <input type="text" name="kode_buku" placeholder="Contoh: BKN-001"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 ml-1">Jumlah Stok</label>
                                <input type="number" name="stock_buku" placeholder="0"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1">Judul Buku</label>
                            <input type="text" name="judul_buku" placeholder="Masukkan judul lengkap buku"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 ml-1">Nama Penulis</label>
                                <input type="text" name="penulis" placeholder="Nama penulis"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700 ml-1">Tahun Terbit</label>
                                <input type="date" name="tahun_terbit"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all text-slate-600">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1">Sinopsis</label>
                            <textarea name="sinopsis" rows="4" placeholder="Tuliskan ringkasan cerita buku..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all resize-none"></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1">Cover Buku</label>
                            <div class="relative group">
                                <input type="file" name="cover_image"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all border border-slate-200 rounded-xl p-1">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-4 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:from-indigo-700 hover:to-violet-700 transition-all transform active:scale-[0.98]">
                                Simpan Data Buku
                            </button>
                            <p class="text-center text-xs text-slate-400 mt-4 italic">Pastikan data yang Anda masukkan sudah
                                benar sebelum menyimpan.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
