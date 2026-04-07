@extends('petugas.layout.index')

@section('petugas')
    <div class="p-6 sm:ml-64">

        <h2 class="text-2xl font-bold mb-6">
            Pengajuan Pengembalian Buku
        </h2>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Buku</th>
                        <th class="p-3">Tgl Pinjam</th>
                        <th class="p-3">Jatuh Tempo</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $i => $p)
                        <tr class="border-t">
                            <td class="p-3">{{ $i + 1 }}</td>
                            <td class="p-3">{{ $p->anggota->nama_lengkap ?? $p->anggota->user->username }}</td>
                            <td class="p-3">{{ $p->buku->judul_buku }}</td>
                            <td class="p-3">{{ $p->tanggal_pinjam }}</td>
                            <td class="p-3">{{ $p->tanggal_jatuh_tempo }}</td>

                            {{-- STATUS TERLAMBAT --}}
                            <td class="p-3">
                                @php
                                    $terlambat = now()->diffInDays($p->tanggal_jatuh_tempo, false);
                                @endphp

                                @if ($terlambat > 0)
                                    <span class="text-red-500 font-semibold">
                                        Terlambat {{ $terlambat }} hari
                                    </span>
                                @else
                                    <span class="text-green-500">
                                        Tidak terlambat
                                    </span>
                                @endif
                            </td>

                            <td class="p-3 text-center">
                                <button onclick="openModal({{ $p->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    Proses
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- MODAL --}}
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded-xl w-full max-w-lg shadow-lg">

            <h2 class="text-xl font-bold mb-4">Proses Pengembalian</h2>

            <button onclick="closeModal()" class="text-red-500 mb-3 text-sm">
                ✖ Tutup
            </button>

            <form id="formPengembalian" method="POST">
                @csrf

                {{-- KONDISI --}}
                <label class="block font-semibold mb-1">Kondisi Buku</label>
                <select name="kondisi" id="kondisi" class="w-full border p-2 rounded mb-3">
                    <option value="normal">Normal</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>

                {{-- RUSAK --}}
                <div id="rusakSection" class="hidden">

                    <label class="block font-semibold mb-1">Tingkat Kerusakan</label>
                    <select name="tingkat_kerusakan" class="w-full border p-2 rounded mb-3">
                        <option value="ringan">Ringan</option>
                        <option value="sedang">Sedang</option>
                        <option value="berat">Berat</option>
                    </select>

                </div>

                {{-- INFO DENDA --}}
                <div id="dendaInfo" class="text-sm text-red-500 mb-3"></div>

                {{-- PEMBAYARAN --}}
                <label class="block font-semibold mb-1">Nominal Bayar</label>
                <input type="number" name="nominal" id="nominal" class="w-full border p-2 rounded mb-2"
                    placeholder="Masukkan uang">

                <div id="infoBayar" class="text-sm mb-3"></div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
                    Simpan
                </button>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.openModal = function(id) {
                document.getElementById('modal').classList.remove('hidden');
                document.getElementById('formPengembalian').action =
                    `/peminjaman/${id}/proses`;
            }

            window.closeModal = function() {
                document.getElementById('modal').classList.add('hidden');
            }

            const kondisi = document.getElementById('kondisi');
            const rusakSection = document.getElementById('rusakSection');

            if (kondisi) {
                kondisi.addEventListener('change', function() {
                    if (this.value === 'rusak') {
                        rusakSection.classList.remove('hidden');
                    } else {
                        rusakSection.classList.add('hidden');
                    }
                });
            }

            const nominalInput = document.getElementById('nominal');
            const infoBayar = document.getElementById('infoBayar');

            if (nominalInput) {
                nominalInput.addEventListener('input', function() {
                    let bayar = parseInt(this.value) || 0;

                    if (bayar <= 0) {
                        infoBayar.innerHTML = "";
                        return;
                    }

                    infoBayar.innerHTML = "Input diterima: Rp " + bayar.toLocaleString();
                });
            }

        });
    </script>
@endsection
