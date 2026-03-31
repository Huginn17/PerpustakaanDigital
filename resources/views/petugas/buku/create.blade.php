<h2>Tambah Buku</h2>

<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Petugas</label>
    <select name="petugas_id">
        @foreach($petugas as $p)
            <option value="{{ $p->id }}">{{ $p->nama }}</option>
        @endforeach
    </select><br>

    <label>Kode Buku</label>
    <input type="number" name="kode_buku"><br>

    <label>Judul</label>
    <input type="text" name="judul_buku"><br>

    <label>Penulis</label>
    <input type="text" name="penulis"><br>

    <label>Tahun</label>
    <input type="number" name="tahun_terbit"><br>

    <label>Stock</label>
    <input type="number" name="stock_buku"><br>

    <label>Cover</label>
    <input type="file" name="cover_image"><br>

    <button type="submit">Simpan</button>
</form>