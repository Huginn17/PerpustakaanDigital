@extends('petugas.layout.index')
@section('petugas')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow">

        <h2 class="text-2xl font-bold mb-4">Pembayaran Denda</h2>

        {{-- INFO --}}
        <div class="mb-6">
            <p><strong>Nama:</strong> {{ $peminjaman->user->name }}</p>
            <p><strong>Buku:</strong> {{ $peminjaman->buku->judul }}</p>
        </div>

        {{-- RINGKASAN --}}
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <p>Total Denda: <strong>Rp {{ number_format($peminjaman->totalDenda()) }}</strong></p>
            <p>Sudah Dibayar: <strong>Rp {{ number_format($peminjaman->totalBayar()) }}</strong></p>
            <p>Sisa Tagihan:
                <strong class="text-red-600">
                    Rp {{ number_format($peminjaman->sisaTagihan()) }}
                </strong>
            </p>
        </div>

        {{-- FORM BAYAR --}}
        <form action="{{ route('peminjaman.bayar', $peminjaman->id) }}" method="POST">
            @csrf

            <label class="block font-semibold mb-2">Nominal Bayar</label>
            <input type="number" name="nominal" id="nominal" class="w-full border rounded-lg p-2 mb-4"
                placeholder="Masukkan uang dari anggota">

            {{-- INFO REALTIME --}}
            <div id="infoBayar" class="text-sm text-gray-600 mb-4"></div>

            <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
                Simpan Pembayaran
            </button>
        </form>

    </div>

    <script>
        const nominalInput = document.getElementById('nominal');
        const info = document.getElementById('infoBayar');

        const sisa = {{ $peminjaman->sisaTagihan() }};

        nominalInput.addEventListener('input', function() {
            let bayar = parseInt(this.value) || 0;

            if (bayar < sisa) {
                info.innerHTML = "⚠️ Masih kurang Rp " + (sisa - bayar);
                info.classList.remove('text-green-600');
                info.classList.add('text-red-600');
            } else if (bayar === sisa) {
                info.innerHTML = "✅ Pas, akan lunas";
                info.classList.remove('text-red-600');
                info.classList.add('text-green-600');
            } else {
                info.innerHTML = "💰 Kembalian Rp " + (bayar - sisa);
                info.classList.remove('text-red-600');
                info.classList.add('text-green-600');
            }
        });
    </script>
@endsection
