<h2 style="text-align:center;">Laporan Perpustakaan</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Petugas</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->anggota->nama_lengkap ?? $item->anggota->user->username }}</td>
            <td>{{ $item->buku->judul_buku }}</td>
            <td>{{ $item->petugas->nama_lengkap ?? $item->petugas->user->username }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembalikan ?? '-' }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>