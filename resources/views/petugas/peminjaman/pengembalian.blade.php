@extends('petugas.layout.index')

@section('petugas')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-bold mb-4">Proses Refund</h2>

        {{-- INFO BUKU --}}
        <div class="mb-4 text-sm">
            <p><b>Nama Buku:</b> {{ $peminjaman->buku->judul_buku ?? '-' }}</p>
            <p><b>Nama Anggota:</b> {{ $peminjaman->anggota->nama_lengkap ?? $peminjaman->anggota->user->username }}</p>
        </div>

        {{-- TOTAL BAYAR --}}
        <div class="mb-4 text-sm text-blue-600">
            <p><b>Total Dibayar:</b> Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
        </div>

        {{-- ERROR --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('refund.proses', $peminjaman->id) }}" method="POST">
            @csrf

            <label class="block font-semibold mb-1">Nominal Refund</label>

            <input type="number" name="nominal" class="w-full border p-2 rounded mb-3"
                placeholder="Masukkan nominal refund">

            <label class="block font-semibold mb-1">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="w-full border p-2 rounded mb-3" placeholder="Contoh: Buku ditemukan, rusak ringan"></textarea>

            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded w-full">
                Proses Refund
            </button>
        </form>

    </div>
@endsection
