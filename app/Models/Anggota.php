<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    
    protected $guarded = [];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
