@extends('petugas.layout.index')

@section('petugas')
    <div class="p-6 sm:ml-64 bg-orange-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Konfirmasi Peminjaman</h1>
                    <p class="text-slate-500 text-sm">Kelola dan verifikasi permintaan peminjaman buku dari anggota.</p>
                </div>
                <div class="bg-orange-500 p-3 rounded-2xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                </div>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 flex items-center bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-sm">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="mb-6 flex items-center bg-orange-50 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-xl shadow-orange-100/50 border border-orange-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-orange-50 to-orange-100/50">
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest">No</th>
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest">Informasi Buku
                                </th>
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest">Peminjam</th>
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest">Tgl Ajukan</th>
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest text-center">
                                    Status</th>
                                <th class="p-5 text-xs font-black text-orange-600 uppercase tracking-widest text-center">
                                    Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-orange-50">
                            @forelse ($peminjaman as $i => $item)
                                <tr class="group hover:bg-orange-50/30 transition-all duration-200">
                                    <td class="p-5">
                                        <span class="text-slate-400 font-bold">#{{ $i + 1 }}</span>
                                    </td>
                                    <td class="p-5">
                                        <div class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">
                                            {{ $item->buku->judul_buku }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 uppercase tracking-tighter">ID Buku:
                                            {{ $item->buku_id }}</div>
                                    </td>
                                    <td class="p-5">
                                        <div class="flex items-center">
                                            {{-- <div
                                                class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3 text-orange-600 font-bold text-xs border border-orange-200">
                                                {{ substr($item->anggota->nama_lengkap ?? $item->anggota->user->username, 0, 1) }}
                                            </div> --}}
                                            <span
                                                class="font-semibold text-slate-700">{{ $item->anggota->nama_lengkap ?? $item->anggota->user->username }}</span>
                                        </div>
                                    </td>
                                    <td class="p-5 text-slate-600 font-medium">
                                        {{ $item->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="p-5 text-center">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'dipinjam' => 'bg-orange-500 text-white border-orange-600',
                                                'ditolak' => 'bg-red-100 text-red-700 border-red-200',
                                            ];
                                            $class = $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span
                                            class="px-3 py-1 text-[10px] font-black uppercase rounded-full border {{ $class }} shadow-sm">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="p-5">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button onclick="openModal({{ $item->id }})"
                                                class="flex items-center justify-center w-9 h-9 bg-white border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white rounded-xl transition-all duration-200 shadow-sm shadow-green-100 active:scale-90"
                                                title="Terima">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>

                                            <button onclick="openModalTolak({{ $item->id }})"
                                                class="flex items-center justify-center w-9 h-9 bg-white border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-200 shadow-sm shadow-red-100 active:scale-90"
                                                title="Tolak">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-orange-50 p-4 rounded-full mb-3">
                                                <svg class="w-10 h-10 text-orange-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                            </div>
                                            <p class="text-slate-400 font-bold">Tidak ada data peminjaman saat ini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @include('components.modalTerima_peminjaman')
            @include('components.modalTolak_peminjman')
        </div>



        <!-- TABLE DATA SELESAI -->
        <div class="mt-10 bg-white rounded-[2rem] shadow-xl shadow-orange-100/50 border border-orange-100 overflow-hidden">
            <div class="p-5 border-b bg-orange-50">
                <h3 class="text-lg font-bold text-orange-600">Riwayat Peminjaman (Sudah Dikonfirmasi)</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-50 to-orange-100/50">
                            <th class="p-5 text-xs font-black text-orange-600 uppercase">No</th>
                            <th class="p-5 text-xs font-black text-orange-600 uppercase">Buku</th>
                            <th class="p-5 text-xs font-black text-orange-600 uppercase">Peminjam</th>
                            <th class="p-5 text-xs font-black text-orange-600 uppercase">Tanggal</th>
                            <th class="p-5 text-xs font-black text-orange-600 uppercase text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-orange-50">
                        @forelse ($peminjamanSelesai as $i => $item)
                            <tr class="hover:bg-orange-50/30 transition">

                                <!-- NO -->
                                <td class="p-5 text-slate-400 font-bold">
                                    #{{ $i + 1 }}
                                </td>

                                <!-- BUKU -->
                                <td class="p-5">
                                    <div class="font-bold text-slate-800">
                                        {{ $item->buku->judul_buku }}
                                    </div>
                                </td>

                                <!-- ANGGOTA -->
                                <td class="p-5">
                                    <div class="flex items-center">
                                        {{-- <div
                                            class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3 text-orange-600 font-bold text-xs">
                                            {{ substr($item->anggota->nama_lengkap ?? '-', 0, 1) }}
                                        </div> --}}
                                        <span class="font-semibold text-slate-700">
                                            {{ $item->anggota->nama_lengkap ?? $item->anggota->user->username}}
                                        </span>
                                    </div>
                                </td>

                                <!-- TANGGAL -->
                                <td class="p-5 text-slate-600">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                                <!-- STATUS -->
                                <td class="p-5 text-center">
                                    @if ($item->status == 'dipinjam')
                                        <span class="px-3 py-1 text-xs font-bold bg-orange-500 text-white rounded-full">
                                            Dipinjam
                                        </span>
                                    @elseif ($item->status == 'dikembalikan')
                                        <span class="px-3 py-1 text-xs font-bold bg-green-500 text-white rounded-full">
                                            Selesai
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-slate-400">
                                    Tidak ada riwayat data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out forwards;
        }
    </style>
@endsection
