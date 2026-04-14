@extends('kepala_perpus.layout.index')
@section('kepala_content')
    <div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
        <div class="p-6">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-800">Dashboard Utama</h1>
                    <p class="text-gray-500 text-sm">Selamat datang kembali, Kepala Perpustakaan.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span
                        class="bg-orange-100 text-orange-600 px-4 py-2 rounded-lg font-semibold text-sm border border-orange-200">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            {{-- CARD STATISTICS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-orange-500 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Total Buku</p>
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $totalBuku }}</h2>
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                viewBox="0 0 256 256">
                                <path
                                    d="M231.65,194.55,198.46,36.75a16,16,0,0,0-19-12.39L132.65,34.42a16.08,16.08,0,0,0-12.3,19l33.19,157.8A16,16,0,0,0,169.16,224a16.25,16.25,0,0,0,3.38-.36l46.81-10.06A16.09,16.09,0,0,0,231.65,194.55ZM136,50.15c0-.06,0-.09,0-.09l46.8-10,3.33,15.87L139.33,66Zm6.62,31.47,46.82-10.05,3.34,15.9L146,97.53Zm6.64,31.57,46.82-10.06,13.3,63.24-46.82,10.06ZM216,197.94l-46.8,10-3.33-15.87L212.67,182,216,197.85C216,197.91,216,197.94,216,197.94ZM104,32H56A16,16,0,0,0,40,48V208a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V48A16,16,0,0,0,104,32ZM56,48h48V64H56Zm0,32h48v96H56Zm48,128H56V192h48v16Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-gray-400 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Total Stok</p>
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $totalStok }}</h2>
                        <div class="p-2 bg-gray-50 rounded-lg text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Dipinjam</p>
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="text-2xl font-bold text-blue-600">{{ $dipinjam }}</h2>
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Kembali Hari Ini</p>
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="text-2xl font-bold text-green-600">{{ $dikembalikanHariIni }}</h2>
                        <div class="p-2 bg-green-50 rounded-lg text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- <div class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-red-500 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Denda Aktif</p>
                    <div class="flex flex-col mt-2">
                        <h2 class="text-lg font-bold text-red-600">
                            Rp {{ number_format($totalDenda, 0, ',', '.') }}
                        </h2>
                        <span class="text-[10px] text-red-400 font-medium">*Perlu ditagih</span>
                    </div>
                </div> --}}

                <div
                    class="bg-white p-5 rounded-2xl shadow-sm border-l-4 border-orange-400 hover:shadow-md transition-shadow">
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Total Anggota</p>
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $anggota }}</h2>
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- TABLE AKTIVITAS --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div
                    class="p-6 border-b border-gray-50 flex justify-between items-center bg-gradient-to-r from-white to-orange-50">
                    <h2 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                        Aktivitas Transaksi Terbaru
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-400 text-[11px] uppercase tracking-widest font-bold">
                                <th class="px-6 py-4">Peminjam</th>
                                <th class="px-6 py-4">Informasi Buku</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tgl Pinjam</th>
                                <th class="px-6 py-4">Denda</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($aktivitas as $item)
                                @php
                                    $denda = \App\Models\Denda::where('peminjaman_id', $item->id)
                                        ->where('status', 'aktif')
                                        ->sum('nominal');
                                @endphp

                                <tr class="hover:bg-orange-50/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-700">{{ $item->anggota->nama_lengkap ?? '-' }}</div>
                                        <div class="text-xs text-gray-400">ID: {{ $item->anggota_id }}</div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 font-medium">
                                        {{ $item->buku->judul_buku ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($item->status == 'dipinjam')
                                            <span
                                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">Dipinjam</span>
                                        @elseif($item->status == 'dikembalikan')
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Kembali</span>
                                        @elseif($item->status == 'menunggu_pembayaran')
                                            <span
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold uppercase">Tertunggak</span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($denda > 0)
                                            <span class="text-red-600 font-bold bg-red-50 px-2 py-1 rounded">
                                                Rp{{ number_format($denda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-200"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-2 text-gray-400">Belum ada aktivitas hari ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
