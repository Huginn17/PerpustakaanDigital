@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-bold mb-4">Setting Peminjaman</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('setting.update') }}" method="POST">
            @csrf

            <label class="block font-semibold mb-1">Denda per Hari</label>
            <input type="text" id="rupiah" name="denda_per_hari"
                value="{{ number_format($setting->denda_per_hari, 0, ',', '.') }}" class="w-full border p-2 rounded mb-3">

            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full">
                Simpan
            </button>
        </form>

    </div>
@endsection
