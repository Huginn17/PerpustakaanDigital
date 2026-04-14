@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-6 sm:ml-64 bg-slate-50 min-h-screen">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">
                    Data <span class="text-orange-500">Pengguna</span>
                </h1>
                <p class="text-slate-500 font-medium text-sm mt-1">Kelola informasi personel dan hak akses sistem.</p>
            </div>

            <a href="{{ route('kepala.pengguna.create') }}"
                class="flex items-center px-6 py-3.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-2xl transition-all shadow-lg shadow-orange-200 active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pengguna
            </a>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th
                                class="px-8 py-5 text-left text-xs font-bold text-slate-400 uppercase tracking-widest text-center w-20">
                                No</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Informasi Pengguna</th>
                            <th class="px-8 py-5 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Level Akses</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-slate-400 uppercase tracking-widest">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($pengguna as $i => $user)
                            <tr class="group hover:bg-orange-50/20 transition-colors">
                                <td class="px-8 py-6 text-center">
                                    <span class="text-slate-400 font-bold text-sm">{{ $i + 1 }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div
                                            class="h-12 w-12 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 font-black text-lg border border-orange-200 shadow-sm">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-slate-800 font-bold text-base leading-none">{{ $user->username }}
                                            </p>
                                            <p class="text-slate-400 text-xs mt-1">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $user->role == 'admin' ? 'bg-orange-500 text-white' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('kepala.pengguna.detail', $user->id) }}"
                                            class="p-2.5 text-slate-400 hover:text-orange-500 hover:bg-white rounded-xl transition-all border border-transparent hover:border-orange-100 hover:shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('kepala.pengguna.edit', $user->id) }}"
                                            class="p-2.5 text-slate-400 hover:text-orange-500 hover:bg-white rounded-xl transition-all border border-transparent hover:border-orange-100 hover:shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('kepala.pengguna.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus pengguna?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="p-2.5 text-slate-400 hover:text-red-500 hover:bg-white rounded-xl transition-all border border-transparent hover:border-red-100 hover:shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
@endsection
