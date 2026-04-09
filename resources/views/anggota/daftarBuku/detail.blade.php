@extends('anggota.layout.index')
@section('anggota')
    <div class="p-4 sm:ml-64">

        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- SUCCESS ALERT --}}
        @if (session('success'))
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- ERROR MESSAGE (custom) --}}
        @if (session('error'))
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl">
                    {{ session('error') }}
                </div>
            </div>
        @endif


        <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-100 mt-10">
            <div class="flex flex-col md:flex-row gap-10">
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('storage/' . $buku->cover_image) }}" class="w-full rounded-xl shadow-xl">
                </div>

                <div class="w-full md:w-2/3">
                    <h1 class="text-3xl font-extrabold text-slate-900">{{ $buku->judul_buku }}</h1>
                    <p class="text-indigo-600 font-medium mb-4">Oleh {{ $buku->penulis }}</p>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="p-3 bg-slate-50 rounded-lg">
                            <p class="text-xs text-slate-500">Kode Buku</p>
                            <p class="font-bold">{{ $buku->kode_buku }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-lg">
                            <p class="text-xs text-slate-500">Stok Tersedia</p>
                            <p class="font-bold">{{ $buku->stock_buku }} Unit</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-bold mb-2">Deskripsi / Sinopsis</h4>
                        <p class="text-slate-600 leading-relaxed">
                            {{ $buku->sinopsis ?? 'Tidak ada sinopsis atau deskripsi untuk buku ini.' }}
                        </p>
                    </div>

                    <div class="flex gap-4">
                        @if ($buku->stock_buku > 0)
                            <form action="{{ route('pinjam.buku') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                                    Ajukan Pinjam Buku
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="flex-1 bg-slate-100 text-slate-400 py-3 rounded-xl font-bold cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif

                        <a href="{{ route('anggota.dashboard') }}"
                            class="px-6 py-3 border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
