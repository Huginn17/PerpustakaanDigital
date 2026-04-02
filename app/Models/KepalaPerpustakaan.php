<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaPerpustakaan extends Model
{
    protected $table = 'kepala_perpustakaans';
    protected $guarded = [];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
