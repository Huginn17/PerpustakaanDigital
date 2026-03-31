<h2>Tambah Buku</h2>

<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Kode Buku</label>
    <input type="text" name="kode_buku"><br>

<label>Judul</label>
    <input type="text" name="judul_buku"><br>

    <label>Penulis</label>
    <input type="text" name="penulis"><br>

    <label>Tahun Terbit</label>
    <input type="date" name="tahun_terbit"><br>

    <label>Sinopsis</label> <br>
    <textarea name="sinopsis" id="" cols="30" rows="10"></textarea><br>

    <label>Stock</label>
    <input type="number" name="stock_buku"><br>

    <label>Cover</label>
    <input type="file" name="cover_image"><br>

    <button type="submit">Simpan</button>
</form>