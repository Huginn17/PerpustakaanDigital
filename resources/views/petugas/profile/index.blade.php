@extends('petugas.layout.index')

@section('petugas')
    <div class="p-4 sm:ml-64 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto mt-8">

            <div class="flex items-center space-x-4 mb-6">
                <div class="p-3 bg-emerald-500 rounded-2xl shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Profil Petugas</h1>
                    <p class="text-slate-500 text-sm">Update informasi akun resmi petugas perpustakaan.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                {{-- Notifikasi --}}
                @if (session('success'))
                    <div
                        class="mx-8 mt-6 flex items-center bg-emerald-50 border border-emerald-100 text-emerald-700 p-4 rounded-2xl animate-fade-in">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('profile.update.petugas') }}" method="POST" enctype="multipart/form-data"
                    class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                        {{-- SISI KIRI: FOTO --}}
                        <div class="flex flex-col items-center space-y-4">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-b from-emerald-400 to-cyan-400 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-500">
                                </div>
                                @if ($petugas->foto_profil)
                                    <img src="{{ asset('storage/' . $petugas->foto_profil) }}"
                                        class="relative w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div
                                        class="relative w-40 h-40 rounded-full bg-slate-100 flex items-center justify-center border-4 border-white shadow-lg text-slate-400">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                @endif

                                <label
                                    class="absolute bottom-2 right-2 bg-emerald-600 p-3 rounded-full text-white cursor-pointer hover:bg-emerald-700 shadow-xl border-2 border-white transition-all transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <input type="file" name="foto_profil" class="hidden">
                                </label>
                            </div>
                            <div class="text-center italic text-xs text-slate-400">
                                Klik ikon kamera untuk ganti foto
                            </div>
                        </div>

                        {{-- SISI KANAN: FORM --}}
                        <div class="lg:col-span-2 space-y-5">

                            {{-- NAMA --}}
                            <div class="relative">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Nama Lengkap
                                    Petugas</label>
                                <div class="flex items-center mt-1">
                                    <div class="absolute pl-4 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="nama_lengkap" value="{{ $petugas->nama_lengkap }}"
                                        placeholder="Nama Lengkap"
                                        class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-medium">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                {{-- NOMOR INDUK --}}
                                <div>
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">NIP /
                                        Nomor Induk</label>
                                    <input type="text" name="nomor_induk" value="{{ $petugas->nomor_induk }}"
                                        placeholder="Nomor Induk"
                                        class="w-full mt-1 px-4 py-3 rounded-2xl bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-medium">
                                </div>

                                {{-- JK --}}
                                <div>
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Jenis
                                        Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="w-full mt-1 px-4 py-3 rounded-2xl bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-medium appearance-none">
                                        <option value="">Pilih...</option>
                                        <option value="L" {{ $petugas->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P" {{ $petugas->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- TANGGAL LAHIR --}}
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Tanggal
                                    Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $petugas->tanggal_lahir }}"
                                    class="w-full mt-1 px-4 py-3 rounded-2xl bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-medium text-slate-600">
                            </div>

                            {{-- ALAMAT --}}
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Alamat
                                    Kantor/Rumah</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full mt-1 px-4 py-3 rounded-2xl bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-medium resize-none text-slate-600">{{ $petugas->alamat }}</textarea>
                            </div>

                            {{-- BUTTON --}}
                            <div class="pt-4">
                                <button
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    <span>Simpan Data Petugas</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mt-8 flex justify-center items-center space-x-2 text-slate-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-xs font-medium tracking-widest uppercase">Verified Staff Member</span>
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
    