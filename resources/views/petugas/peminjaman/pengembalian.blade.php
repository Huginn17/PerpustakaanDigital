@extends('petugas.layout.index')
@section('petugas')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow">

        <h2 class="text-2xl font-bold mb-4">Pengembalian Buku</h2>

        {{-- Info Peminjaman --}}
        <div class="mb-6">
            <p><strong>Nama:</strong> {{ $peminjaman->anggota->user->username ?? $peminjaman->anggota->nama_lengkap }}</p>
            <p><strong>Buku:</strong> {{ $peminjaman->buku->judul_buku }}</p>
            <p><strong>Jatuh Tempo:</strong> {{ $peminjaman->tanggal_jatuh_tempo }}</p>
        </div>

        <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
            @csrf

            {{-- KONDISI BUKU --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Kondisi Buku</label>
                <select name="kondisi" id="kondisi" class="w-full border rounded-lg p-2">
                    <option value="normal">Normal</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            {{-- RUSAK SECTION --}}
            <div id="rusakSection" class="hidden border p-4 rounded-lg bg-yellow-50 mb-4">

                <label class="block font-semibold mb-2">Tingkat Kerusakan</label>
                <select name="tingkat_kerusakan" id="tingkat" class="w-full border rounded-lg p-2 mb-3">
                    <option value="ringan">Ringan (5.000)</option>
                    <option value="sedang">Sedang (20.000)</option>
                    <option value="berat">Berat (50.000)</option>
                </select>

                <label class="block font-semibold mb-2">Nominal Custom (Opsional)</label>
                <input type="number" name="nominal_custom" class="w-full border rounded-lg p-2 mb-3"
                    placeholder="Kosongkan jika pakai default">

                <label class="block font-semibold mb-2">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded-lg p-2" placeholder="Wajib jika override"></textarea>

            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Proses Pengembalian
            </button>
        </form>
    </div>

    <script>
        const kondisi = document.getElementById('kondisi');
        const rusakSection = document.getElementById('rusakSection');

        kondisi.addEventListener('change', function() {
            if (this.value === 'rusak') {
                rusakSection.classList.remove('hidden');
            } else {
                rusakSection.classList.add('hidden');
            }
        });
    </script>
@endsection
