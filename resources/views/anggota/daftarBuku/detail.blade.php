@extends('anggota.layout.index')
@section('anggota')
    <div class="p-15 sm:ml-70 bg-[#fdfdfd] min-h-screen">
        <div class="max-w-7xl mx-auto py-6">

            <div class="flex items-center justify-between mb-16">
                <a href="{{ route('anggota.dashboard') }}" class="group flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center group-hover:bg-orange-500 group-hover:border-orange-500 transition-all duration-300">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 group-hover:text-slate-900 transition-colors">Kembali
                        Ke Koleksi</span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <div class="text-right">
                        <p
                            class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1 text-right">
                            Ketersediaan Unit</p>
                        <p class="text-xl font-black text-slate-900 leading-none italic">{{ $buku->stock_buku }} Buku</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center">
                        <div
                            class="w-3 h-3 rounded-full bg-orange-500 {{ $buku->stock_buku > 0 ? 'animate-pulse' : 'bg-red-500' }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALERT NOTIFICATION --}}
            @if (session('success') || session('error'))
                <div class="mb-12 animate-[fadeIn_0.5s_ease-out]">
                    <div
                        class="{{ session('success') ? 'bg-orange-500' : 'bg-red-600' }} p-6 rounded-[2rem] shadow-2xl shadow-orange-200 text-white flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="font-bold tracking-wide">{{ session('success') ?? session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                <div class="lg:col-span-5 relative">
                    <div class="absolute inset-0 bg-orange-100 rounded-[3rem] rotate-3 scale-95 opacity-50"></div>
                    <div class="absolute inset-0 bg-orange-500/10 rounded-[3rem] -rotate-2 scale-95 opacity-50"></div>

                    <div
                        class="relative bg-white p-4 rounded-[3.5rem] shadow-[0_60px_100px_-20px_rgba(0,0,0,0.12)] border border-slate-100">
                        @if ($buku->cover_image)
                            <img src="{{ asset('storage/' . $buku->cover_image) }}"
                                class="w-full aspect-[3/4.2] object-cover rounded-[3rem]" alt="{{ $buku->judul_buku }}">
                        @else
                            <div class="w-full aspect-[3/4.2] bg-slate-50 rounded-[3rem] flex items-center justify-center">
                                <span class="text-slate-200 font-black italic text-4xl uppercase tracking-tighter">No
                                    Cover</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="max-w-2xl">
                        <div class="mb-10">
                            <p
                                class="text-orange-500 font-black text-xs uppercase tracking-[0.4em] mb-6 flex items-center gap-4">
                                <span class="w-10 h-px bg-orange-500"></span>
                                {{ $buku->kode_buku }}
                            </p>
                            <h1 class="text-7xl font-black text-slate-900 leading-[0.85] tracking-tighter mb-6 ">
                                {{ $buku->judul_buku }}
                            </h1>
                            <p class="text-2xl font-bold text-slate-400 italic">Ditulis oleh <span
                                    class="text-slate-800 underline decoration-orange-500/30 underline-offset-8">{{ $buku->penulis }}</span>
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-8 mb-12">
                            <div class="border-l-4 border-orange-500 pl-6 py-2">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Tahun Terbit
                                </p>
                                <p class="text-xl font-black text-slate-800 tracking-tight">
                                    {{ \Carbon\Carbon::parse($buku->tahun_terbit)->format('Y') }}</p>
                            </div>
                            <div
                                class="border-l-4 border-slate-200 pl-6 py-2 group hover:border-orange-500 transition-colors">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Status Rak
                                </p>
                                <p class="text-xl font-black text-slate-800 tracking-tight italic">
                                    {{ $buku->stock_buku > 0 ? 'Tersedia' : 'Kosong' }}</p>
                            </div>
                        </div>

                        <div class="mb-12 relative">
                            <p class="text-slate-500 text-xl leading-relaxed font-medium italic indent-12">
                                {{ $buku->sinopsis ?? 'Sinopsis untuk mahakarya ini sedang dalam tahap penyusunan oleh tim pustakawan kami.' }}
                            </p>
                            <svg class="absolute -top-4 -left-2 w-10 h-10 text-orange-100" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21L14.017 18C14.017 16.8954 14.9125 16 16.0171 16H19.0171V14H17.0171C15.3603 14 14.0171 12.6569 14.0171 11V7H20.0171V14.3821C20.0171 15.274 19.6621 16.1293 19.0171 16.7451V21H14.0171ZM4.01712 21L4.01712 18C4.01712 16.8954 4.91256 16 6.01712 16H9.01712V14H7.01712C5.36026 14 4.01712 12.6569 4.01712 11V7H10.0171V14.3821C10.0171 15.274 9.66212 16.1293 9.01712 16.7451V21H4.01712Z" />
                            </svg>
                        </div>

                        <div class="flex items-center gap-6">
                            <button onclick="openModal({{ $buku->id }}, '{{ $buku->judul_buku }}')"
                                class="group relative w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-orange-200 transition-all duration-300 hover:-translate-y-0.5 active:scale-95">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform group-hover:rotate-12" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>

                                <span>Pinjam Buku Ini</span>
                            </button>

                        </div>


                        <div id="modalPinjam" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                                onclick="closeModal()"></div>

                            <div
                                class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl transform transition-all overflow-hidden">

                                <div
                                    class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                    <h2 class="text-xl font-semibold text-gray-800">Ajukan Peminjaman</h2>
                                    <button onclick="closeModal()"
                                        class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="p-6">
                                    <div class="mb-5 p-4 bg-orange-50 rounded-lg border border-orange-100">
                                        <p class="text-xs font-semibold text-orange-600 uppercase tracking-wider mb-1">Buku
                                            yang dipilih:</p>
                                        <p id="judulBuku" class="text-sm font-medium text-gray-700"></p>
                                    </div>

                                    <form method="POST" action="{{ route('pinjam.buku') }}" class="space-y-4">
                                        @csrf
                                        <input type="hidden" name="buku_id" id="buku_id">

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Tanggal Jatuh Tempo
                                            </label>
                                            <input type="date" name="tanggal_jatuh_tempo" id="jatuhTempo"
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none"
                                                required>
                                            <p class="mt-1.5 text-xs text-gray-500 italic">*Pilih tanggal pengembalian
                                                buku.
                                            </p>
                                        </div>

                                        <div class="flex flex-col gap-3 pt-2">
                                            <button type="submit"
                                                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow-md shadow-orange-200 transition-all active:scale-[0.98]">
                                                Konfirmasi Peminjaman
                                            </button>
                                            <button type="button" onclick="closeModal()"
                                                class="w-full bg-white border border-gray-300 text-gray-600 font-medium py-2.5 rounded-lg hover:bg-gray-50 transition-all">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const MAX_HARI = {{ $setting->max_hari_pinjam ?? 14 }};

        function formatDateLocal(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');

            return `${year}-${month}-${day}`;
        }

        function openModal(id, judul) {
            document.getElementById('modalPinjam').classList.remove('hidden');

            document.getElementById('buku_id').value = id;
            document.getElementById('judulBuku').innerText = judul;

            let today = new Date();
            let maxDate = new Date();

            // FIX DI SINI (BIAR HARI INI IKUT DIHITUNG)
            maxDate.setDate(today.getDate() + MAX_HARI - 1);

            let input = document.getElementById('jatuhTempo');

            input.min = formatDateLocal(today); // hari ini boleh
            input.max = formatDateLocal(maxDate); // batas max
            input.value = formatDateLocal(maxDate); // default
        }

        function closeModal() {
            document.getElementById('modalPinjam').classList.add('hidden');
        }
    </script>

    <style>
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
