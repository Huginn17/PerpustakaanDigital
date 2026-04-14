@extends('anggota.layout.index')

@section('anggota')
    <div class="p-10 sm:ml-70 bg-[#fffaf5] min-h-screen font-sans">
        <div class="max-w-5xl mx-auto">
            {{-- HEADER BAR --}}
            <div
                class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 bg-white p-6 rounded-[2.5rem] shadow-sm border border-orange-100/50">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 bg-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-200 rotate-3 transition-transform hover:rotate-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Pengaturan Profil</h1>
                        <p class="text-orange-500 font-medium text-sm italic">Anggota Perpustakaan</p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <span
                        class="px-4 py-2 bg-orange-50 text-orange-600 rounded-full text-xs font-bold border border-orange-100 uppercase tracking-widest">
                        ID Member: #{{ $anggota->nomor_induk }}
                    </span>
                </div>
            </div>

            <form action="{{ route('profile.update.anggota') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    {{-- LEFT SIDE: PHOTO CARD --}}
                    <div class="lg:col-span-4">
                        <div
                            class="bg-white rounded-[3rem] p-8 border border-orange-100 shadow-xl shadow-orange-100/20 text-center sticky top-8">
                            <div class="relative inline-block mb-6 group">
                                <div
                                    class="w-44 h-44 p-2 bg-orange-50 rounded-full transition-transform group-hover:scale-105 duration-500">
                                    <div class="w-full h-full overflow-hidden rounded-full border-4 border-white shadow-md">
                                        @if ($anggota->foto_profil)
                                            <img id="preview" src="{{ asset('storage/' . $anggota->foto_profil) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <label
                                    class="absolute bottom-2 right-2 w-12 h-12 bg-orange-600 rounded-2xl flex items-center justify-center text-white cursor-pointer transition-all shadow-lg hover:scale-110 active:scale-95 border-4 border-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <input type="file" name="foto_profil" class="hidden" onchange="previewImage(event)">
                                </label>
                            </div>

                            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">
                                {{ $anggota->nama_lengkap }}</h2>
                            <p class="text-slate-400 text-sm mb-6">{{ $anggota->nomor_induk }}</p>

                            <div class="space-y-3">
                                <div
                                    class="bg-orange-50 p-4 rounded-2xl flex items-center space-x-3 group hover:bg-orange-100 transition-colors">
                                    <div
                                        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-orange-600 shadow-sm">
                                        @if ($anggota->jenis_kelamin == 'P')
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M208,96a80,80,0,1,0-88,79.6V200H88a8,8,0,0,0,0,16h32v24a8,8,0,0,0,16,0V216h32a8,8,0,0,0,0-16H136V175.6A80.11,80.11,0,0,0,208,96ZM64,96a64,64,0,1,1,64,64A64.07,64.07,0,0,1,64,96z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M216,32H168a8,8,0,0,0,0,16h28.69L154.62,90.07a80,80,0,1,0,11.31,11.31L208,59.32V88a8,8,0,0,0,16,0V40A8,8,0,0,0,216,32zM149.24,197.29a64,64,0,1,1,0-90.53A64.1,64.1,0,0,1,149.24,197.29z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Gender</p>
                                        <p class="text-sm font-bold text-slate-700">
                                            {{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE: MAIN FORM CARD --}}
                    <div class="lg:col-span-8">
                        <div
                            class="bg-slate-900 rounded-[3rem] p-8 md:p-12 shadow-2xl relative overflow-hidden border border-white/5">
                            {{-- Decorative Blobs --}}
                            <div
                                class="absolute top-0 right-0 w-64 h-64 bg-orange-600/20 rounded-full blur-[80px] -mr-32 -mt-32">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-40 h-40 bg-orange-400/10 rounded-full blur-[60px] -ml-20 -mb-20">
                            </div>

                            @if (session('success'))
                                <div
                                    class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-400 flex items-center animate-fade-in relative z-10">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-bold">{{ session('success') }}</span>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 gap-7 relative z-10">
                                {{-- NAMA LENGKAP --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-orange-400 text-[10px] font-black uppercase tracking-[0.3em] ml-1">Nama
                                        Lengkap</label>
                                    {{-- Kita gunakan bg-white/90 atau bg-slate-100 agar text-black terlihat jelas --}}
                                    <input type="text" name="nama_lengkap" value="{{ $anggota->nama_lengkap }}"
                                        class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-black focus:ring-4 focus:ring-orange-600/50 transition-all duration-300 font-bold italic">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- TANGGAL LAHIR --}}
                                    <div class="space-y-2">
                                        <label
                                            class="text-orange-400 text-[10px] font-black uppercase tracking-[0.3em] ml-1">Tanggal
                                            Lahir</label>
                                        <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir }}"
                                            class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-black focus:ring-4 focus:ring-orange-600/50 transition-all duration-300 font-bold">
                                    </div>

                                    {{-- JENIS KELAMIN --}}
                                    <div class="space-y-2">
                                        <label
                                            class="text-orange-400 text-[10px] font-black uppercase tracking-[0.3em] ml-1">Jenis
                                            Kelamin</label>
                                        <div class="relative">
                                            <select name="jenis_kelamin"
                                                class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-black focus:ring-4 focus:ring-orange-600/50 transition-all duration-300 font-bold appearance-none">
                                                <option value="L"
                                                    {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="P"
                                                    {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-slate-900">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- NOMOR INDUK --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-orange-400 text-[10px] font-black uppercase tracking-[0.3em] ml-1">Nomor
                                        Induk Anggota</label>
                                    <input type="text" name="nomor_induk" value="{{ $anggota->nomor_induk }}"
                                        class="w-full bg-slate-200/80 border-none rounded-2xl px-6 py-4 text-black/70 cursor-not-allowed font-mono tracking-wider font-bold"
                                        >
                                </div>

                                {{-- ALAMAT --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-orange-400 text-[10px] font-black uppercase tracking-[0.3em] ml-1">Alamat
                                        Domisili</label>
                                    <textarea name="alamat" rows="3"
                                        class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-black focus:ring-4 focus:ring-orange-600/50 transition-all duration-300 font-bold resize-none leading-relaxed italic">{{ $anggota->alamat }}</textarea>
                                </div>

                                {{-- SUBMIT BUTTON --}}
                                <div class="pt-6">
                                    <button type="submit"
                                        class="w-full bg-orange-600 hover:bg-orange-500 text-white font-black py-5 rounded-2xl transition-all duration-300 shadow-xl shadow-orange-900/40 flex items-center justify-center space-x-3 group active:scale-95">
                                        <span class="tracking-[0.2em] text-sm uppercase">Simpan Perubahan</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) sepia(100%) saturate(1000%) hue-rotate(0deg);
            cursor: pointer;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
