@extends('petugas.layout.index')

@section('petugas')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="p-6 sm:ml-64 bg-slate-50 min-h-screen">

        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-slate-800">Dashboard Petugas</h1>
            <p class="text-slate-500">Selamat datang kembali! Berikut ringkasan aktivitas perpustakaan hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div
                class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-3xl shadow-xl group transition-all hover:scale-[1.02]">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-orange-100 font-medium tracking-wide">Total Koleksi Buku</h4>
                        <p class="text-4xl font-black text-white mt-2">{{ $totalBuku }}</p>
                    </div>
                    <div class="bg-white/20 p-4 rounded-2xl">
                        <i class="fa-solid fa-book text-3xl text-white"></i>
                    </div>
                </div>
                <div class="mt-4 text-orange-100 text-xs font-light">Tersedia di katalog</div>
            </div>

            <div
                class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-md border border-orange-100 transition-all hover:shadow-lg hover:shadow-orange-100 group">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-slate-500 font-medium">Peminjaman Aktif</h4>
                        <p class="text-4xl font-black text-orange-600 mt-2">{{ $totalPeminjaman }}</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-2xl group-hover:bg-orange-100 transition-colors">
                        <i class="fa-solid fa-hand-holding-heart text-3xl text-orange-500"></i>
                    </div>
                </div>
                {{-- <div class="mt-4 flex items-center text-orange-600 text-xs font-semibold uppercase tracking-wider">
                    <span class="flex h-2 w-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                    Sedang dipinjam
                </div> --}}
            </div>

            <div
                class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-md border border-orange-100 transition-all hover:shadow-lg hover:shadow-orange-100 group">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-slate-500 font-medium">Pengembalian Berhasil</h4>
                        <p class="text-4xl font-black text-orange-600 mt-2">{{ $totalPengembalian }}</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-2xl group-hover:bg-orange-100 transition-colors">
                        <i class="fa-solid fa-circle-check text-3xl text-orange-500"></i>
                    </div>
                </div>
                {{-- <div class="mt-4 text-slate-400 text-xs font-light italic">Data bulan ini</div> --}}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-white">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                        Konfirmasi Peminjaman
                    </h3>
                    <span
                        class="bg-orange-100 text-orange-600 text-[10px] px-2.5 py-1 rounded-full font-bold uppercase">{{ $peminjamanPending->count() }}
                        Perlu Dicek</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Buku / Judul</th>
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Peminjam</th>
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Tanggal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($peminjamanPending as $p)
                                <tr class="hover:bg-orange-50/30 transition-colors group">
                                    <td class="p-4">
                                        <div
                                            class="font-semibold text-slate-700 group-hover:text-orange-600 transition-colors">
                                            {{ $p->buku->judul_buku }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono">ID: #{{ $p->id }}</div>
                                    </td>
                                    <td class="p-4 text-slate-600 font-medium">{{ $p->anggota->nama_lengkap ?? $p->anggota->user->username }}</td>
                                    <td class="p-4 text-right">
                                        <span
                                            class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-10 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-folder-open text-3xl text-slate-200 mb-2"></i>
                                            <p class="text-slate-400 text-sm">Semua peminjaman beres!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-orange-400 rounded-full"></span>
                        Konfirmasi Pengembalian
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Info Buku</th>
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Oleh</th>
                                <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Tgl
                                    Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pengembalianPending as $k)
                                <tr class="hover:bg-orange-50/30 transition-colors">
                                    <td class="p-4">
                                        <div class="font-semibold text-slate-700">{{ $k->buku->judul_buku }}</div>
                                    </td>
                                    <td class="p-4 text-slate-600">{{ $k->anggota->nama_lengkap ?? $k->anggota->user->username }}</td>
                                    <td class="p-4 text-right text-orange-600 font-semibold italic text-xs">
                                        {{ \Carbon\Carbon::parse($k->tanggal_kembalikan)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-10 text-center text-slate-400 text-sm">Belum ada
                                        pengembalian baru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
