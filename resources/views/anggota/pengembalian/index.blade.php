@extends('anggota.layout.index')

@section('anggota')
    <div class="p-6 sm:ml-80 bg-[#fdfbf9] min-h-screen font-sans">

        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Perpustakaan <span
                        class="text-orange-500">Digital</span></h1>
                <p class="text-gray-500 font-medium">Kelola buku yang sedang Anda pinjam dengan mudah.</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-orange-100">
                <div class="bg-orange-500 text-white p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="pr-4">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Pinjaman</p>
                    <p class="text-xl font-bold text-gray-800">{{ count($data) }} Buku</p>
                </div>
            </div>
        </div>

        @if (session('success') || session('error'))
            <div class="mb-6 animate-bounce-short">
                @if (session('success'))
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-xl shadow-sm flex items-center">
                        <div class="text-orange-500 mr-3">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-orange-800">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm flex items-center">
                        <div class="text-red-500 mr-3">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-xl shadow-orange-100/50 border border-orange-50 overflow-hidden">
            <div
                class="p-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-white to-orange-50/30">
                <h2 class="text-lg font-bold text-gray-700">Daftar Pinjaman Aktif</h2>
                <span class="bg-orange-100 text-orange-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Update
                    Real-time</span>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[11px] uppercase tracking-[0.15em] font-black bg-gray-50/50">
                            <th class="px-8 py-5 text-center">No</th>
                            <th class="px-6 py-5">Detail Buku</th>
                            <th class="px-6 py-5">Waktu Pinjam</th>
                            <th class="px-6 py-5 text-center">Status Tempo</th>
                            <th class="px-8 py-5 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($data as $index => $p)
                            <tr class="group hover:bg-orange-50/50 transition-all duration-300">
                                <td class="px-8 py-6 text-center">
                                    <span
                                        class="text-gray-300 group-hover:text-orange-400 font-bold transition-colors">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-gray-800 font-extrabold text-base group-hover:text-orange-600 transition-colors uppercase leading-tight">{{ $p->buku->judul_buku }}</span>
                                        <span class="text-xs text-gray-400 mt-1 font-medium">ID Transaksi:
                                            #TRX-{{ $p->id }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                                        <span
                                            class="text-sm text-gray-600 font-semibold">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col items-center">
                                        @php
                                            $terlambat = now()
                                                ->startOfDay()
                                                ->diffInDays(
                                                    \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->startOfDay(),
                                                    false,
                                                );
                                        @endphp

                                        @if ($terlambat > 0)
                                            <div
                                                class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-xl text-[11px] font-black border border-blue-100">
                                                {{ $terlambat }} HARI LAGI
                                            </div>
                                        @elseif ($terlambat == 0)
                                            <div
                                                class="bg-orange-500 text-white px-4 py-1.5 rounded-xl text-[11px] font-black shadow-lg shadow-orange-200 animate-pulse">
                                                HARI INI
                                            </div>
                                        @else
                                            <div
                                                class="bg-red-50 text-red-600 px-4 py-1.5 rounded-xl text-[11px] font-black border border-red-100">
                                                TELAT {{ abs($terlambat) }} HARI
                                            </div>
                                        @endif
                                        <span class="text-[10px] text-gray-400 mt-2 font-bold uppercase">Hingga
                                            {{ \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->format('d M') }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <form action="{{ route('peminjaman.ajukan', $p->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-white border-2 border-orange-500 text-orange-600 hover:bg-orange-500 hover:text-white px-5 py-2 rounded-xl text-xs font-black transition-all duration-300 transform active:scale-90 hover:shadow-lg hover:shadow-orange-200"
                                            onclick="return confirm('Kembalikan buku ini sekarang?')">
                                            KEMBALIKAN
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-32 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="text-orange-200 mb-4 text-6xl italic font-black opacity-30 italic">
                                            KOSONG</div>
                                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada buku
                                            yang dipinjam</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> <br>


        {{-- Main Table Card --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-orange-100/40 border border-orange-50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    
                    <thead>
                        <tr
                            class="bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs uppercase tracking-widest font-bold">
                            <th class="px-6 py-5 text-center">No</th>
                            <th class="px-6 py-5">Informasi Buku</th>
                            <th class="px-6 py-5">Tanggal Transaksi</th>
                            <th class="px-6 py-5 text-center">Status Transaksi</th>
                            <th class="px-6 py-5 text-center">Aksi / Detail</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        {{-- MENGGABUNGKAN SEMUA DATA --}}
                        @forelse ($semua as $index => $item)
                            <tr class="hover:bg-orange-50/50 transition-colors">
                                <td class="px-6 py-6 text-center text-gray-400 font-bold">{{ $index + 1 }}</td>

                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-gray-800 font-extrabold text-sm uppercase">{{ $item->buku->judul_buku }}</span>
                                        <span class="text-[10px] text-gray-400 mt-1">ID: #{{ $item->id }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    <div class="text-xs font-semibold text-gray-600">
                                        Pinjam: <span
                                            class="text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                                    </div>
                                    @if ($item->tanggal_kembalikan)
                                        <div class="text-[10px] font-bold text-green-600 mt-1 uppercase">
                                            Kembali:
                                            {{ \Carbon\Carbon::parse($item->tanggal_kembalikan)->format('d M Y') }}
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-6 text-center">
                                    @if ($item->status == 'Dipinjam')
                                        <span
                                            class="bg-orange-100 text-orange-600 px-3 py-1.5 rounded-full text-[10px] font-black uppercase border border-orange-200">
                                            Sedang Dipinjam
                                        </span>
                                    @elseif($item->status == 'Menunggu Pembayaran' || $item->status == 'Denda')
                                        <span
                                            class="bg-red-100 text-red-600 px-3 py-1.5 rounded-full text-[10px] font-black uppercase border border-red-200 animate-pulse">
                                            Bayar Denda
                                        </span>
                                    @elseif($item->status == 'Dikembalikan')
                                        <span
                                            class="bg-green-100 text-green-600 px-3 py-1.5 rounded-full text-[10px] font-black uppercase border border-green-200">
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-[10px] font-black uppercase border border-gray-200">
                                            {{ $item->status }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-6 text-center">
                                    @if ($item->status == 'Dipinjam')
                                        <form action="{{ route('peminjaman.ajukan', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-[10px] font-black transition-all shadow-md shadow-orange-200 active:scale-95"
                                                onclick="return confirm('Ajukan pengembalian buku ini?')">
                                                KEMBALIKAN
                                            </button>
                                        </form>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <a href="#"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-[10px] font-black transition-all shadow-md shadow-red-200 inline-block">
                                            BAYAR SEKARANG
                                        </a>
                                    @else
                                        <span class="text-gray-300 text-[10px] font-bold italic">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-sm italic">Belum
                                        ada riwayat aktivitas</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <style>
        @keyframes bounce-short {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .animate-bounce-short {
            animation: bounce-short 2s infinite;
        }
    </style>
@endsection
