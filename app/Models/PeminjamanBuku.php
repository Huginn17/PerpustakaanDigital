<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBuku extends Model
{
    protected $table = 'peminjaman_buku';
    protected $guarded = [];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    

} 
