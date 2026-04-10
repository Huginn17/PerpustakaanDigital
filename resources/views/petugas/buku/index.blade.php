@extends('petugas.layout.index')
@section('petugas')
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@300;400;600;800&display=swap" rel="stylesheet">


    <div class="p-6 sm:ml-64 bg-[#fcfcfb] min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-orange-500 rounded-[2rem] p-10 relative overflow-hidden group">
                    <div class="relative z-10">
                        <h1 class="text-white text-4xl font-extrabold tracking-tight">Koleksi Buku</h1>
                        <p class="text-orange-100 mt-2 max-w-md font-medium">Manajemen pustaka untuk memantau sirkulasi dan
                            ketersediaan buku secara instan.</p>
                        <div class="mt-8">
                            <a href="{{ route('buku.create') }}"
                                class="bg-white text-orange-600 px-6 py-3 rounded-xl font-bold text-sm shadow-xl hover:bg-orange-50 transition-all inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-width="2.5" stroke-linecap="round" />
                                </svg>
                                Entri Buku Baru
                            </a>
                        </div>
                    </div>
                    <div
                        class="absolute -bottom-10 -right-10 w-64 h-64 bg-orange-400 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>

                <div
                    class="bg-white border border-slate-200 rounded-[2rem] p-10 flex flex-col justify-center items-center shadow-sm">
                    {{-- <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Total Buku</span> --}}
                    <span class="text-7xl font-extrabold text-slate-800 my-2">{{ count($buku) }}</span>
                    <span class="text-orange-500 font-semibold text-sm">Volume Buku Terdaftar</span>
                </div>
            </div>

            <form method="GET" class="mb-6 flex gap-3">

                <select name="filter" onchange="this.form.submit()"
                    class="px-4 py-2 border justify-end border-orange-200 rounded-xl text-sm focus:ring-orange-400 focus:border-orange-400">

                    <option value="">Semua Buku</option>
                    <option value="habis" {{ request('filter') == 'habis' ? 'selected' : '' }}>Stock Habis</option>
                    <option value="menipis" {{ request('filter') == 'menipis' ? 'selected' : '' }}>Stock Menipis</option>
                    <option value="tersedia" {{ request('filter') == 'tersedia' ? 'selected' : '' }}>Stock Tersedia</option>

                </select>

            </form>

            <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">
                <div class="p-8 border-b border-orange-500 flex justify-between items-center bg-orange-500">
                    <h3 class="font-bold text-white text-xl">Buku Yang Terdaftar</h3>
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-slate-200"></div>
                        <div class="w-3 h-3 rounded-full bg-slate-200"></div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-black text-[15px]">
                                <th class="px-8 py-6">Kode Buku</th>
                                <th class="px-8 py-6">Judul Buku</th>
                                <th class="px-8 py-6 hidden md:table-cell">Tahun Terbit</th>
                                <th class="px-8 py-6 text-center">Stock Buku</th>
                                <th class="px-8 py-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($buku as $b)
                                <tr class="group hover:bg-orange-50/30 transition-all duration-300">
                                    <td class="px-8 py-6">
                                        <span class="font-mono text-sm text-slate-400">#{{ $b->kode_buku }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="font-bold text-slate-800 text-lg group-hover:text-orange-600 transition-colors">
                                            {{ $b->judul_buku }}</div>
                                        <div class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Penulis:
                                            {{ $b->penulis }}</div>
                                    </td>
                                    <td class="px-8 py-6 hidden md:table-cell max-w-[250px]">
                                        <p class="text-sm text-slate-500 truncate leading-relaxed">
                                            {{ $b->tahun_terbit }}
                                        </p>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div
                                            class="inline-block min-w-[3rem] py-1 px-3 rounded-lg border-2 {{ $b->stock_buku < 5 ? 'border-rose-200 bg-rose-50 text-rose-600' : 'border-slate-100 bg-slate-50 text-slate-600' }} font-black">
                                            {{ $b->stock_buku }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3">

                                            <!-- EDIT -->
                                            <a href="{{ route('buku.edit', $b->id) }}"
                                                class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slat-400 hover:text-orange-500 hover:border-orange-200 shadow-sm transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    fill="#000000" viewBox="0 0 256 256">
                                                    <path
                                                        d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160,136,75.31,152.69,92,68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188,164,103.31,180.69,120Zm96-96L147.31,64l24-24L216,84.68Z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <!-- DELETE -->
                                            <form action="{{ route('buku.destroy', $b->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus data?')"
                                                    class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-rose-500 hover:border-rose-200 shadow-sm transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
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

            @if (session('success'))
                <div
                    class="fixed bottom-10 right-10 bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl border border-white/10 animate-bounce-short flex items-center gap-4">
                    <div class="bg-orange-500 p-1 rounded-full">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

        </div>
    </div>
@endsection
