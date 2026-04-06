@extends('petugas.layout.index')

@section('petugas')
    <div class="p-4 sm:ml-64">

        @if (session('error'))
            <div class="bg-red-500 text-white p-2 mb-2">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 mb-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Judul Buku</th>
                        <th class="p-3">Anggota</th>
                        <th class="p-3">Tanggal Ajukan</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $i => $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $i + 1 }}</td>

                            <td class="p-3">
                                {{ $item->buku->judul_buku }}
                            </td>

                            <td class="p-3">
                                {{ $item->anggota->nama_lengkap ?? Auth::user()->username }}
                            </td>

                            <td class="p-3">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>


                            <td class="p-3">
                                <span
                                    class="px-2 py-1 text-xs rounded 
                            @if ($item->status == 'pending') bg-yellow-200 text-yellow-800
                            @elseif($item->status == 'dipinjam') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800 @endif">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="p-3 text-center space-x-2">
                                <!-- Setujui -->
                                <button onclick="openModal({{ $item->id }})"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                    Terima
                                </button>

                                <!-- Tolak -->
                                <button onclick="openModalTolak({{ $item->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Tolak
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




        @include('components.modalTerima_peminjaman')
        @include('components.modalTolak_peminjman')


    </div>
@endsection
