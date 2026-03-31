<h2>Edit Buku</h2>

<form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Kode Buku</label>
    <input type="text" name="kode_buku" value="{{ $buku->kode_buku }}"><br>

    <label>Judul</label>
    <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}"><br>

    <label>Penulis</label>
    <input type="text" name="penulis" value="{{ $buku->penulis }}"><br>

    <label>Tahun Terbit</label>
    <input type="date" name="tahun_terbit" value="{{ $buku->tahun_terbit }}"><br>

    <label for="sinopsis">Sinopsis</label> <br>
    <textarea name="sinopsis" id="sinopsis" cols="30" rows="10">{{ $buku->sinopsis }}</textarea><br>

    <label>Stock</label>
    <input type="number" name="stock_buku" value="{{ $buku->stock_buku }}"><br>

    <label>Cover Buku</label><br>

    @if ($buku->cover_image)
        <img src="{{ asset('storage/' . $buku->cover_image) }}" width="120"><br>
    @endif

    <input type="file" name="cover_image"><br>

    <button type="submit">Update</button>
</form>
