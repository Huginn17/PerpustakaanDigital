@extends('anggota.layout.index')
@section('anggota')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="p-4 sm:ml-64">
        <div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold text-white tracking-tight drop-shadow-lg">
                        📚 Perpustakaan <span class="text-yellow-300">Ajaib</span>
                    </h2>
                    <p class="mt-2 text-lg text-indigo-100 italic">Temukan petualanganmu di setiap lembaran buku.</p>
                </div>

                <div class="max-w-md mx-auto mb-8">
                    @if (session('success'))
                        <div
                            class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md animate-bounce">
                            <p class="font-bold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                            <p class="font-bold">Oops!</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($bukus as $buku)
                        <div
                            class="glass-effect rounded-3xl overflow-hidden shadow-2xl transform transition duration-500 hover:scale-105 hover:rotate-1">

                            <div class="relative group">
                                @if ($buku->cover_image)
                                    <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Cover"
                                        class="w-full h-64 object-cover">
                                @else
                                    <div
                                        class="w-full h-64 bg-gradient-to-tr from-gray-200 to-gray-400 flex items-center justify-center">
                                        <span class="text-gray-500 italic text-sm">No Cover Available</span>
                                    </div>
                                @endif

                                <div
                                    class="absolute top-4 left-4 bg-white/80 px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-sm">
                                    #{{ $buku->kode_buku }}
                                </div>

                                <div class="absolute bottom-4 right-4 shadow-lg">
                                    <span
                                        class="px-3 py-1 rounded-lg text-xs font-bold {{ $buku->stock_buku > 0 ? 'bg-green-400 text-white' : 'bg-red-400 text-white' }}">
                                        {{ $buku->stock_buku > 0 ? 'Tersedia: ' . $buku->stock_buku : 'Habis' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-1 truncate" title="{{ $buku->judul_buku }}">
                                    {{ $buku->judul_buku }}
                                </h3>
                                <p class="text-indigo-600 font-medium text-sm mb-4">✍️ {{ $buku->penulis }}</p>

                                <div class="mt-4">
                                    @if ($buku->stock_buku > 0)
                                        <form action="{{ route('pinjam.buku') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-300 flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h1V7z" />
                                                </svg>
                                                Pinjam Buku
                                            </button>
                                        </form>
                                    @else
                                        <button disabled
                                            class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-4 rounded-xl cursor-not-allowed italic">
                                            Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
