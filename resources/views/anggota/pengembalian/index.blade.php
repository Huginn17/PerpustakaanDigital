@extends('anggota.layout.index')
@section('anggota')
    <div class="p-6 sm:ml-64">

        <h2 class="text-2xl font-bold mb-6">
            Buku Yang Sedang Dipinjam
        </h2>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Buku</th>
                        <th class="p-3">Tanggal Pinjam</th>
                        <th class="p-3">Jatuh Tempo</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $index => $p)
                        <tr class="border-t">

                            <td class="p-3">{{ $index + 1 }}</td>

                            <td class="p-3">
                                {{ $p->buku->judul_buku }}
                            </td>

                            <td class="p-3">
                                {{ $p->tanggal_pinjam }}
                            </td>

                            <td class="p-3">
                                {{ $p->tanggal_jatuh_tempo }}
                            </td>

                            <td class="p-3">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
                                    Dipinjam
                                </span>

                                {{-- INFO TERLAMBAT --}}
                                @php
                                    $terlambat = now()
                                        ->startOfDay()
                                        ->diffInDays(
                                            \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->startOfDay(),
                                            false,
                                        );
                                @endphp

                                @if ($terlambat > 0)
                                    <div class="text-red-500 text-xs">
                                        Jatuh tempo dalam {{ $terlambat }} hari lagi
                                    </div>
                                @elseif ($terlambat == 0)
                                    <div class="text-yellow-500 text-xs">
                                        Jatuh tempo hari ini
                                    </div>
                                @else
                                    <div class="text-green-500 text-xs">
                                        Tepat waktu
                                    </div>
                                @endif
                            </td>

                            <td class="p-3 text-center">

                                <form action="{{ route('peminjaman.ajukan', $p->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-xs"
                                        onclick="return confirm('Ajukan pengembalian buku ini?')">
                                        Ajukan Pengembalian
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">
                                Tidak ada buku yang sedang dipinjam
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>
@endsection
