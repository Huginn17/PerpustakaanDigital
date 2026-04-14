@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <div class="p-6 sm:ml-64 bg-gray-50 min-h-screen">

        {{-- Header Section --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Laporan <span
                        class="text-orange-500">Aktivitas</span></h2>
                <p class="text-gray-500 mt-1">Pantau dan ekspor data peminjaman serta pengembalian buku.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('kepala.laporan.pdf', request()->all()) }}"
                    class="flex items-center gap-2 bg-white border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-300 shadow-sm shadow-red-100 uppercase tracking-wider">
                    <i class="ph-bold ph-file-pdf text-lg"></i>
                    Export PDF
                </a>
            </div>
        </div>

        {{-- Filter Card --}}
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-orange-50 mb-8">
            <form method="GET" action="{{ route('kepala.laporan.index') }}" class="flex flex-wrap items-end gap-4">

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Cari
                        Data</label>
                    <div class="relative">
                        <input type="text" name="search" placeholder="Nama anggota atau judul buku..."
                            value="{{ request('search') }}"
                            class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 transition-all outline-none">
                    </div>
                </div>

                <div class="w-full md:w-48">
                    <label
                        class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Status</label>
                    <select name="status"
                        class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-orange-500 transition-all outline-none appearance-none">
                        <option value="">Semua Status</option>
                        <option value="peminjaman" {{ request('status') == 'peminjaman' ? 'selected' : '' }}>Peminjaman
                        </option>
                        <option value="pengembalian" {{ request('status') == 'pengembalian' ? 'selected' : '' }}>
                            Pengembalian</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-orange-200 active:scale-95">
                    Terapkan Filter
                </button>

                @if (request()->anyFilled(['search', 'status']))
                    <a href="{{ route('kepala.laporan.index') }}"
                        class="text-gray-400 hover:text-orange-500 text-sm font-bold pb-3 underline decoration-2 underline-offset-4 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-orange-100/40 border border-orange-50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-orange-50/50 text-orange-700 uppercase text-[11px] font-black tracking-widest">
                            <th class="px-8 py-5 text-center">No</th>
                            <th class="px-6 py-5">Informasi Peminjam</th>
                            <th class="px-6 py-5">Buku</th>
                            <th class="px-6 py-5">Waktu Transaksi</th>
                            <th class="px-6 py-5">Petugas</th>
                            <th class="px-8 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($data as $item)
                            <tr class="hover:bg-orange-50/30 transition-colors duration-200">
                                <td class="px-8 py-6 text-center text-gray-400 font-bold text-sm">
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </td>

                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-gray-800 font-extrabold text-sm uppercase">
                                            {{ $item->anggota->nama_lengkap ?? $item->anggota->user->username }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-bold tracking-tight">ID ANGGOTA:
                                            #{{ $item->anggota->id ?? '?' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    <span
                                        class="text-gray-700 font-bold text-sm leading-tight block truncate max-w-[200px]">
                                        {{ $item->buku->judul_buku }}
                                    </span>
                                </td>

                                <td class="px-6 py-6 text-xs">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-gray-500 font-medium">Pinjam: <b
                                                class="text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</b></span>
                                        @if ($item->tanggal_kembalikan)
                                            <span class="text-green-600 font-medium italic">Kembali:
                                                <b>{{ \Carbon\Carbon::parse($item->tanggal_kembalikan)->format('d M Y') }}</b></span>
                                        @else
                                            <span class="text-gray-300 italic font-medium">Belum Kembali</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    <div class="inline-flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full">
                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                        @if ($item->petugas)
                                            {{ $item->petugas->nama_lengkap ?? $item->petugas->user->username }}
                                        @else
                                            <span class="text-red-500">Belum dikonfirmasi</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    @php
                                        $statusClass =
                                            [
                                                'Dipinjam' => 'bg-orange-100 text-orange-600 border-orange-200',
                                                'Dikembalikan' => 'bg-green-100 text-green-600 border-green-200',
                                                'Denda' => 'bg-red-100 text-red-600 border-red-200',
                                            ][$item->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                    @endphp
                                    <span
                                        class="{{ $statusClass }} px-4 py-1.5 rounded-xl text-[10px] font-black uppercase border tracking-widest">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="ph-bold ph-folder-open text-6xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-xs">Data laporan
                                            tidak ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Section --}}
            <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-50">
                {{ $data->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
