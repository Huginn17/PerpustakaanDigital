<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function dendas()
    {
        return $this->hasMany(Denda::class, 'peminjaman_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'peminjaman_id');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER LOGIC 🔥
    |--------------------------------------------------------------------------
    */

    // ambil denda yang masih aktif
    public function dendaAktif()
    {
        return $this->dendas()->where('status', 'aktif');
    }

    // total semua denda
    public function totalDenda()
    {
        return $this->dendaAktif()->sum('nominal');
    }

    // total pembayaran (bayar - refund)
    public function totalBayar()
    {
        $bayar = $this->pembayaran()
            ->where('tipe', 'bayar')
            ->sum('nominal');

        $refund = $this->pembayaran()
            ->where('tipe', 'refund')
            ->sum('nominal');

        return $bayar - $refund;
    }

    // sisa tagihan
    public function sisaTagihan()
    {
        return $this->totalDenda() - $this->totalBayar();
    }

    // cek sudah lunas atau belum
    public function isLunas()
    {
        return $this->sisaTagihan() <= 0;
    }

    // hitung hari terlambat (real-time)
    public function hariTerlambat()
    {
        if (!$this->tanggal_kembali) return 0;

        return max(
            0,
            Carbon::parse($this->tanggal_kembali)
                ->diffInDays(Carbon::parse($this->tanggal_jatuh_tempo))
        );
    }
}
