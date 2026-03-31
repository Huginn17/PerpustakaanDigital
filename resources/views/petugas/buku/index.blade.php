<h2>Data Buku</h2>

<a href="{{ route('buku.create') }}">Tambah Buku</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Kode</th>
        <th>Judul</th>
        <th>Sinopsis</th>
        <th>Penulis</th>
        <th>Stock</th>
        <th>Aksi</th>
    </tr>

    @foreach($buku as $buku)
    <tr>
        <td>{{ $buku->kode_buku }}</td>
        <td>{{ $buku->judul_buku }}</td>
        <td>{{ $buku->sinopsis }}</td>
        <td>{{ $buku->penulis }}</td>
        <td>{{ $buku->stock_buku }}</td>
        <td>
            <a href="{{ route('buku.edit', $buku->id) }}">Edit</a>

            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>