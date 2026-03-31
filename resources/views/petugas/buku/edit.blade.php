<h2>Edit Buku</h2>

<form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Kode Buku</label>
    <input type="number" name="kode_buku" value="{{ $buku->kode_buku }}"><br>

    <label>Judul</label>
    <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"><br>

    <label>Penulis</label>
    <input type="text" name="penulis" value="{{ $buku->penulis }}"><br>

    <label>Stock</label>
    <input type="number" name="stock_buku" value="{{ $buku->stock_buku }}"><br>

    <button type="submit">Update</button>
</form>