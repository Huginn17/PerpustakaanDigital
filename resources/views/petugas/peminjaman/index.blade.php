@extends('petugas.layout.index')

@section('petugas')
    <div class="p-6 sm:ml-64">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">
                Pengajuan <span class="text-orange-500">Pengembalian Buku</span>
            </h2>
            <p class="text-gray-500 mb-8">Kelola data pengembalian dan pantau status keterlambatan anggota.</p>

            {{-- ALERT --}}
            @if (session('success'))
                <div
                    class="flex items-center bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 animate-fade-in">
                    <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl shadow-orange-100/50 overflow-hidden border border-orange-50 mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-orange-500 to-amber-400 text-white">
                                <th class="p-5 text-xs">No</th>
                                <th class="p-5 text-xs">Informasi Peminjam</th>
                                <th class="p-5 text-xs">Buku</th>
                                <th class="p-5 text-xs">Masa Pinjam</th>
                                <th class="p-5 text-xs text-center">Status & Durasi</th>
                                <th class="p-5 text-xs text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($prosesDenda as $i => $p)
                                @if ($p->status == 'dipinjam' || $p->status == 'menunggu_konfirmasi')
                                    <tr class="hover:bg-orange-50/30 transition-colors group">

                                        <td class="p-5 text-gray-400">{{ $i + 1 }}</td>

                                        <td class="p-5">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold mr-3 border border-orange-200">
                                                    {{ substr($p->anggota->nama_lengkap ?? $p->anggota->user->username, 0, 1) }}
                                                </div>
                                                <div class="font-bold text-gray-700">
                                                    {{ $p->anggota->nama_lengkap ?? $p->anggota->user->username }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-5">
                                            <span class="font-semibold text-gray-700">{{ $p->buku->judul_buku }}</span>
                                            <span class="text-[11px] text-gray-400 italic">ID:
                                                #BK-{{ $p->buku->id }}</span>
                                        </td>

                                        <td class="p-5 text-sm text-gray-600">
                                            <span>Pinjam: <b>{{ $p->tanggal_pinjam }}</b></span><br>
                                            <span class="text-orange-400">Tempo: <b>{{ $p->tanggal_jatuh_tempo }}</b></span>
                                        </td>

                                        {{-- STATUS (SAMA PERSIS) --}}
                                        <td class="p-5 text-center">
                                            @php
                                                $today = now()->startOfDay();
                                                $jatuhTempo = \Carbon\Carbon::parse(
                                                    $p->tanggal_jatuh_tempo,
                                                )->startOfDay();
                                            @endphp

                                            @if ($today->gt($jatuhTempo))
                                                @php $terlambat = (int) $jatuhTempo->diffInDays($today); @endphp
                                                <span class="text-red-500 font-bold">Terlambat {{ $terlambat }}
                                                    Hari</span>
                                            @elseif ($today->equalTo($jatuhTempo))
                                                <span class="text-amber-500 font-bold">Hari Ini</span>
                                            @else
                                                @php $sisa = (int) $today->diffInDays($jatuhTempo); @endphp
                                                <span class="text-emerald-500 font-bold">{{ $sisa }} Hari
                                                    Lagi</span>
                                            @endif
                                        </td>

                                        {{-- AKSI (SAMA) --}}
                                        <td class="p-5 text-center">
                                            <button
                                                onclick="openModal(
                                        {{ $p->id }},
                                        '{{ $p->buku->judul_buku }}',
                                        '{{ $p->anggota->nama_lengkap }}',
                                        '{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('Y-m-d') }}',
                                        '{{ \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->format('Y-m-d') }}'
                                    )"
                                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl">
                                                Proses
                                            </button>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="bg-white rounded-3xl shadow-xl shadow-orange-100/50 overflow-hidden border border-orange-50">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-orange-500 to-amber-400 text-white">
                                <th class="p-5 text-xs">No</th>
                                <th class="p-5 text-xs">Informasi Peminjam</th>
                                <th class="p-5 text-xs">Buku</th>
                                <th class="p-5 text-xs">Masa Pinjam</th>
                                <th class="p-5 text-xs text-center">Status & Durasi</th>
                                <th class="p-5 text-xs text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($pembayaranDenda as $i => $p)
                                @if ($p->status == 'menunggu_pembayaran')
                                    <tr class="hover:bg-orange-50/30">

                                        <td class="p-5 text-gray-400">{{ $i + 1 }}</td>

                                        <td class="p-5">
                                            {{ $p->anggota->nama_lengkap ?? $p->anggota->user->username }}
                                        </td>

                                        <td class="p-5">
                                            {{ $p->buku->judul_buku }}
                                        </td>

                                        <td class="p-5">
                                            {{ $p->tanggal_pinjam }} <br>
                                            <span class="text-orange-400">{{ $p->tanggal_jatuh_tempo }}</span>
                                        </td>

                                        <td class="p-5 text-center">
                                            <span class="text-amber-500 font-bold">Menunggu Pembayaran</span>
                                        </td>

                                        <td class="p-5 text-center">
                                            <a href="{{ route('pembayaran.show', $p->id) }}"
                                                class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2 rounded-xl">
                                                Bayar
                                            </a>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>



        <div id="modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-6">
            <div class="fixed inset-0 bg-orange-950/40 backdrop-blur-sm transition-opacity"></div>

            <div
                class="relative bg-white rounded-[1.5rem] shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-orange-100">

                <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-6 text-white relative">
                    <h2 class="text-xl font-bold tracking-tight">Proses Pengembalian</h2>
                    <p class="text-orange-100 text-xs opacity-90">Selesaikan administrasi dengan teliti.</p>

                    <button onclick="closeModal()"
                        class="absolute top-5 right-5 bg-white/20 hover:bg-white/40 p-1.5 rounded-full transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-90 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    {{-- INFO DATA - Grid tetap 2 kolom namun teks lebih rapat --}}
                    <div
                        class="bg-orange-50/50 border border-orange-100 p-4 rounded-xl mb-5 grid grid-cols-2 gap-y-2 gap-x-3 text-xs">
                        <div class="col-span-2 border-b border-orange-100 pb-1 mb-1">
                            <p class="text-[9px] uppercase tracking-widest text-orange-400 font-bold">Detail Peminjam</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px]">Nama</p>
                            <p id="m_nama" class="font-semibold text-gray-700 truncate">-</p>
                        </div>

                        <script>
                            const DENDA_PER_HARI = {{ $setting->denda_per_hari ?? 10000 }};
                        </script>
                        <div>
                            <p class="text-gray-400 text-[10px]">Buku</p>
                            <p id="m_buku" class="font-semibold text-gray-700 truncate">-</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px]">Tgl Pinjam</p>
                            <p id="m_pinjam" class="font-semibold text-gray-700">-</p>
                        </div>
                        <div>
                            <p class="text-red-300 text-[10px]">Jatuh Tempo</p>
                            <p id="m_jatuh" class="font-semibold text-red-500">-</p>
                        </div>
                        <div
                            class="col-span-2 pt-2 border-t border-orange-100 flex justify-between items-center text-[11px]">
                            <span class="text-gray-400 italic" id="m_status">Status</span>
                            <span class="text-orange-600 font-bold" id="m_denda">Rp 0</span>
                        </div>
                    </div>

                    <form id="formPengembalian" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="total_denda" id="inputTotalDenda">

                        {{-- KONDISI --}}
                        <div class="space-y-1">
                            <label class="block font-bold text-gray-600 text-xs ml-1">Kondisi Buku</label>
                            <select name="kondisi" id="kondisi"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-orange-400 focus:ring-0 p-2.5 rounded-lg text-sm transition-all outline-none cursor-pointer">
                                <option value="normal">✨ Normal / Baik</option>
                                <option value="rusak">⚠️ Rusak</option>
                                <option value="hilang">❌ Hilang</option>
                            </select>
                        </div>

                        {{-- RUSAK SECTION --}}
                        <div id="rusakSection" class="hidden animate-fade-in space-y-1">
                            <label class="block font-bold text-gray-600 text-xs ml-1">Tingkat Kerusakan</label>
                            <select name="tingkat_kerusakan"
                                class="w-full bg-orange-50 border-2 border-orange-200 p-2.5 rounded-lg text-sm outline-none text-orange-800">
                                <option value="ringan">Ringan</option>
                                <option value="sedang">Sedang</option>
                                <option value="berat">Berat</option>
                            </select>
                        </div>

                        {{-- INPUT DENDA --}}
                        <div id="kerusakanInput" class="hidden animate-fade-in space-y-1">
                            <label class="block font-bold text-gray-600 text-xs ml-1">Biaya Tambahan</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400 text-sm">Rp</span>
                                <input type="number" name="denda_kerusakan" id="dendaKerusakan"
                                    class="w-full bg-gray-50 border-2 border-gray-100 focus:border-orange-400 p-2.5 pl-10 rounded-lg text-sm outline-none"
                                    placeholder="0">
                            </div>
                        </div>

                        {{-- TOTAL PANEL: Dibuat lebih tipis --}}
                        <div class="bg-gray-900 rounded-xl p-4 flex justify-between items-center shadow-md">
                            <div class="text-gray-400 text-[10px] uppercase tracking-wider">Total Bayar</div>
                            <div class="text-white text-lg font-bold italic" id="totalDenda">Rp 0</div>
                        </div>

                        <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600 active:scale-[0.97] text-white font-bold py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 text-sm">
                            Simpan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
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
                animation: fadeIn 0.3s ease-out forwards;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                let dendaTerlambat = 0;

                window.openModal = function(id, buku, nama, tglPinjam, jatuhTempo) {

                    document.getElementById('modal').classList.remove('hidden');
                    document.getElementById('formPengembalian').action =
                        `/peminjaman/${id}/proses`;

                    // isi data
                    document.getElementById('m_buku').innerText = buku;
                    document.getElementById('m_nama').innerText = nama;
                    document.getElementById('m_pinjam').innerText = tglPinjam;
                    document.getElementById('m_jatuh').innerText = jatuhTempo;

                    // reset
                    document.getElementById('kondisi').value = 'normal';
                    document.getElementById('dendaKerusakan').value = '';
                    document.getElementById('inputTotalDenda').value = 0;

                    document.getElementById('rusakSection').classList.add('hidden');
                    document.getElementById('kerusakanInput').classList.add('hidden');

                    let today = new Date();
                    today.setHours(0, 0, 0, 0);

                    let jatuh = new Date(jatuhTempo);
                    jatuh.setHours(0, 0, 0, 0);

                    console.log("Jatuh tempo:", jatuhTempo);
                    console.log("Denda setting:", DENDA_PER_HARI);

                    if (isNaN(jatuh.getTime())) {
                        document.getElementById('m_status').innerHTML =
                            `<span class="text-red-500">Format tanggal salah</span>`;
                        return;
                    }

                    let selisih = Math.floor((today - jatuh) / (1000 * 60 * 60 * 24));

                    if (selisih > 0) {
                        dendaTerlambat = selisih * Number(DENDA_PER_HARI);

                        document.getElementById('m_status').innerHTML =
                            `<span class="text-red-500 font-semibold">Terlambat ${selisih} hari</span>`;

                        document.getElementById('m_denda').innerText =
                            "Rp " + dendaTerlambat.toLocaleString();

                    } else {
                        dendaTerlambat = 0;

                        document.getElementById('m_status').innerHTML =
                            `<span class="text-green-500 font-semibold">Tidak terlambat</span>`;

                        document.getElementById('m_denda').innerText = "Rp 0";
                    }

                    updateTotal();
                }

                window.closeModal = function() {
                    document.getElementById('modal').classList.add('hidden');
                }

                const kondisi = document.getElementById('kondisi');
                const rusakSection = document.getElementById('rusakSection');
                const kerusakanInput = document.getElementById('kerusakanInput');
                const dendaKerusakan = document.getElementById('dendaKerusakan');

                kondisi.addEventListener('change', function() {

                    if (this.value === 'rusak') {
                        rusakSection.classList.remove('hidden');
                        kerusakanInput.classList.remove('hidden');

                    } else if (this.value === 'hilang') {
                        rusakSection.classList.add('hidden');
                        kerusakanInput.classList.remove('hidden');

                    } else {
                        rusakSection.classList.add('hidden');
                        kerusakanInput.classList.add('hidden');
                        dendaKerusakan.value = '';
                    }

                    updateTotal();
                });

                dendaKerusakan.addEventListener('input', updateTotal);

                function updateTotal() {
                    let kerusakan = parseInt(dendaKerusakan.value) || 0;
                    let total = dendaTerlambat + kerusakan;

                    document.getElementById('totalDenda').innerText =
                        "Rp " + total.toLocaleString();

                    document.getElementById('inputTotalDenda').value = total;
                }

                document.getElementById('formPengembalian').addEventListener('submit', function(e) {

                    let total = document.getElementById('inputTotalDenda').value;

                    if (total == 0) {
                        if (!confirm("Tidak ada denda, lanjutkan pengembalian?")) {
                            e.preventDefault();
                        }
                    }
                });

            });
        </script>
    @endsection
