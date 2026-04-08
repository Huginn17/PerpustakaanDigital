@extends('petugas.layout.index')
@section('petugas')
    <div class="max-w-md mx-auto my-10 animate-fade-in">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-orange-100 overflow-hidden border border-orange-50">

            <div class="bg-gradient-to-br from-orange-500 to-amber-500 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight">Pembayaran Denda</h2>
                        <p class="text-orange-100 text-xs opacity-90 mt-1 italic">Pastikan nominal sesuai dengan tagihan.</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-6">

                {{-- INFO PEMINJAM - Glass Card --}}
                <div class="bg-orange-50/50 border border-orange-100 p-4 rounded-2xl space-y-2">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-black text-orange-400 tracking-widest">Nama Peminjam</span>
                        <span
                            class="text-sm font-bold text-gray-700">{{ $peminjaman->anggota->nama_lengkap ?? $peminjaman->anggota->user->username }}</span>
                    </div>
                    <div class="flex flex-col border-t border-orange-100 pt-2">
                        <span class="text-[10px] uppercase font-black text-orange-400 tracking-widest">Judul Buku</span>
                        <span class="text-sm font-bold text-gray-700 italic">"{{ $peminjaman->buku->judul_buku }}"</span>
                    </div>
                </div>

                {{-- RINGKASAN DENDA - Elegant Stats --}}
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div class="p-3 bg-red-50 rounded-2xl border border-red-100">
                        <p class="text-[9px] uppercase font-black text-red-400">Total</p>
                        <p class="text-xs font-bold text-red-600 leading-tight">Rp {{ number_format($totalDenda) }}</p>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-2xl border border-emerald-100">
                        <p class="text-[9px] uppercase font-black text-emerald-400">Dibayar</p>
                        <p class="text-xs font-bold text-emerald-600 leading-tight">Rp {{ number_format($totalBayar) }}</p>
                    </div>
                    <div class="p-3 bg-orange-500 rounded-2xl shadow-lg shadow-orange-200">
                        <p class="text-[9px] uppercase font-black text-orange-100">Sisa</p>
                        <p class="text-xs font-bold text-white leading-tight">Rp {{ number_format($sisa) }}</p>
                    </div>
                </div>

                {{-- FORM BAYAR --}}
                @if ($sisa > 0)
                    <form method="POST" action="{{ route('pembayaran.proses', $peminjaman->id) }}" class="space-y-4 pt-2">
                        @csrf

                        <div class="space-y-2">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Nominal
                                Pembayaran</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-4 text-orange-500 font-bold">Rp</span>
                                <input type="number" name="nominal" id="nominal"
                                    class="w-full bg-gray-50 border-2 border-gray-100 focus:border-orange-400 focus:ring-4 focus:ring-orange-50 p-4 pl-12 rounded-2xl outline-none transition-all font-black text-lg text-gray-700"
                                    placeholder="0">
                            </div>
                        </div>

                        {{-- INFO KEMBALIAN - Floating Style --}}
                        <div id="infoKembalian" class="text-center min-h-[20px] transition-all duration-300"></div>

                        <button
                            class="group w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-orange-200 active:scale-95 transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-widest">
                            <span>Proses Pembayaran</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                @else
                    <div
                        class="bg-emerald-50 border-2 border-dashed border-emerald-200 rounded-[2rem] p-10 text-center space-y-3">
                        <div
                            class="bg-emerald-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto shadow-lg shadow-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-emerald-600 font-black text-xl">Lunas!</p>
                            <p class="text-emerald-400 text-xs">Seluruh denda telah diselesaikan.</p>
                        </div>
                    </div>
                @endif

                <a href="{{ route('peminjaman.pengajuan') }}"
                    class="block text-center text-xs font-bold text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest pt-2">
                    ← Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nominal = document.getElementById('nominal');
            const info = document.getElementById('infoKembalian');
            let sisa = {{ $sisa }};

            if (nominal) {
                nominal.addEventListener('input', function() {
                    let bayar = parseInt(this.value) || 0;

                    if (bayar <= 0) {
                        info.innerHTML = "";
                        return;
                    }

                    let kurang = sisa - bayar;

                    if (kurang > 0) {
                        info.innerHTML =
                            `<div class="bg-blue-50 text-blue-600 py-2 px-4 rounded-xl border border-blue-100 text-[11px] font-bold uppercase">Sisa Tagihan: Rp ${kurang.toLocaleString()}</div>`;
                    } else if (kurang === 0) {
                        info.innerHTML =
                            `<div class="bg-emerald-100 text-emerald-700 py-2 px-4 rounded-xl border border-emerald-200 text-[11px] font-bold uppercase tracking-widest animate-bounce">⚡ Uang Pas / Lunas ⚡</div>`;
                    } else {
                        info.innerHTML =
                            `<div class="bg-amber-50 text-amber-600 py-2 px-4 rounded-xl border border-amber-100 text-[11px] font-bold uppercase italic">Kembalian: Rp ${Math.abs(kurang).toLocaleString()}</div>`;
                    }
                });
            }
        });
    </script>
@endsection
