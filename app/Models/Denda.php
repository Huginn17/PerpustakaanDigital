<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';
    protected $guarded = [];

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanBuku::class);
    }

    // relasi ke denda sebelumnya (parent)
    public function parent()
    {
        return $this->belongsTo(Denda::class, 'denda_parent_id');
    }

    // relasi ke revisi berikutnya
    public function children()
    {
        return $this->hasMany(Denda::class, 'denda_parent_id');
    }
}
