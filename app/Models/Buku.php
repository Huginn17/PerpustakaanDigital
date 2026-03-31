<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $guarded = [];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
