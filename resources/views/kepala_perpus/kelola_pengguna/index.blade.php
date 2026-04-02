@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <div class="p-6 sm:ml-64 bg-[#f0f2f5] min-h-screen font-sans">

        {{-- Header Section dengan Background Gradient --}}
        <div
            class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-3xl p-8 mb-8 shadow-2xl">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-black text-white tracking-tight uppercase italic">
                        Member <span class="text-yellow-300">Galaxy</span>
                    </h1>
                    <p class="text-indigo-100 font-medium">Kelola kru perpustakaan dalam satu kendali kosmik.</p>
                </div>

                <a href="{{ route('kepala.pengguna.create') }}"
                    class="group relative inline-flex items-center px-8 py-3.5 font-bold text-white transition-all duration-300 bg-white/20 backdrop-blur-md border-2 border-white/30 rounded-full hover:bg-white hover:text-indigo-600">
                    <span
                        class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    TAMBAH KRU BARU
                </a>
            </div>
            {{-- Elemen Dekoratif --}}
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>
        </div>

        {{-- Alert dengan Animasi --}}
        @if (session('success'))
            <div
                class="animate-bounce mb-6 flex items-center p-4 text-white bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl shadow-lg">
                <div class="bg-white/20 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="font-bold uppercase tracking-wider text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Container Kartu Tabel --}}
        <div class="bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden border border-white">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-8 py-6 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Rank
                            </th>
                            <th class="px-8 py-6 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Profile Identity</th>
                            <th class="px-8 py-6 text-center text-xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Access Level</th>
                            <th class="px-8 py-6 text-right text-xs font-black text-gray-400 uppercase tracking-[0.2em]">
                                Command</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($pengguna as $i => $user)
                            <tr class="hover:bg-indigo-50/30 transition-all duration-300">
                                <td class="px-8 py-6">
                                    <span
                                        class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 text-gray-500 font-black text-sm">
                                        #{{ $i + 1 }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <div
                                                class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-black shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform">
                                                {{ strtoupper(substr($user->username, 0, 1)) }}
                                            </div>
                                            {{-- <div
                                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-4 border-white rounded-full">
                                            </div> --}}
                                        </div>
                                        <div class="ml-5">
                                            <h3 class="text-gray-900 font-extrabold text-lg leading-tight">
                                                {{ $user->username }}</h3>
                                            <p class="text-indigo-400 font-medium text-sm">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @php
                                        $roleColor =
                                            $user->role == 'admin'
                                                ? 'from-orange-400 to-red-500'
                                                : 'from-blue-400 to-indigo-500';
                                    @endphp
                                    <span
                                        class="px-4 py-1.5 rounded-full bg-gradient-to-r {{ $roleColor }} text-white text-[10px] font-black uppercase tracking-widest shadow-md">
                                        {{ str_replace('_', ' ', $user->role) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('kepala.pengguna.edit', $user->id) }}"
                                            class="p-3 text-amber-500 hover:bg-amber-100 rounded-2xl transition-colors border-2 border-amber-50 shadow-sm"
                                            title="Edit User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('kepala.pengguna.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data kru ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="p-3 text-red-500 hover:bg-red-100 rounded-2xl transition-colors border-2 border-red-50 shadow-sm"
                                                title="Delete User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Custom font import jika ingin lebih unik */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
@endsection
