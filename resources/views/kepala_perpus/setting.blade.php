@extends('kepala_perpus.layout.index')

@section('kepala_content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <div class="p-6 sm:ml-64 min-h-screen bg-[#fafafa] font-['Plus_Jakarta_Sans'] flex items-center justify-center">

        <div class="w-full max-w-xl">

            {{-- Header Kecil --}}
            <div class="mb-6 flex items-center justify-between px-2">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-500 rounded-lg shadow-lg shadow-orange-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Konfigurasi <span
                            class="text-orange-500">Sistem</span></h2>
                </div>
            </div>

            <div
                class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden relative">

                {{-- Decorative Glow --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-100 rounded-full blur-3xl opacity-50"></div>

                {{-- Notification --}}
                @if (session('success'))
                    <div
                        class="m-6 bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-2xl animate-fade-in relative z-10">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-orange-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold text-orange-800 text-sm">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('setting.update') }}" method="POST" class="p-8 md:p-10 relative z-10">
                    @csrf

                    <div class="mb-10 text-center">
                        <p class="text-slate-400 text-xs font-black uppercase tracking-[0.2em] mb-2">
                            Peraturan Perpustakaan
                        </p>
                        <h3 class="text-2xl font-bold text-slate-800">Pengaturan Peminjaman</h3>
                    </div>

                    <div class="space-y-6">

                        {{-- Denda --}}
                        <div class="relative group">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block group-focus-within:text-orange-500 transition-colors">
                                Nominal Denda (Rupiah/Hari)
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold">Rp</span>
                                </div>
                                <input type="text" id="rupiah" name="denda_per_hari"
                                    value="{{ number_format($setting->denda_per_hari, 0, ',', '.') }}"
                                    class="w-full pl-12 pr-6 py-5 rounded-[1.5rem] bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-50 transition-all outline-none font-extrabold text-slate-700 text-lg shadow-inner">
                            </div>

                            <p class="mt-3 text-[10px] text-slate-400 italic font-medium px-2">
                                *Pastikan nominal denda sesuai kebijakan.
                            </p>
                        </div>

                        {{-- Max Hari Pinjam --}}
                        <div class="relative group">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block group-focus-within:text-orange-500 transition-colors">
                                Maksimal Hari Peminjaman
                            </label>

                            <div class="relative">
                                <input type="number" name="max_hari_pinjam" value="{{ $setting->max_hari_pinjam ?? 14 }}"
                                    class="w-full px-6 py-5 rounded-[1.5rem] bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-50 transition-all outline-none font-extrabold text-slate-700 text-lg shadow-inner"
                                    min="1">
                            </div>

                            <p class="mt-3 text-[10px] text-slate-400 italic font-medium px-2">
                                *Jumlah maksimal hari buku boleh dipinjam.
                            </p>
                        </div>

                    </div>

                    <div class="mt-10">
                        <button
                            class="group relative w-full bg-slate-900 text-white font-black py-5 rounded-2xl shadow-xl hover:shadow-orange-200 transition-all duration-500 hover:-translate-y-1 overflow-hidden">
                            <div class="absolute inset-0 w-0 bg-orange-500 transition-all duration-500 group-hover:w-full">
                            </div>
                            <div
                                class="relative z-10 flex items-center justify-center space-x-3 uppercase tracking-[0.15em] text-xs">
                                <span>Simpan Konfigurasi</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-300 text-[10px] mt-8 uppercase tracking-[0.3em] font-bold">
                Secure Settings &bull; 2026 Admin Panel
            </p>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-5px);
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
