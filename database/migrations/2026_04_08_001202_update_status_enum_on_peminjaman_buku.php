<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE peminjaman_buku 
            MODIFY status ENUM(
                'dipinjam',
                'dikembalikan',
                'menunggu_konfirmasi',
                'pending',
                'ditolak',
                'menunggu_pembayaran'
            ) DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE peminjaman_buku 
            MODIFY status ENUM(
                'dipinjam',
                'dikembalikan',
                'menunggu_konfirmasi',
                'pending',
                'ditolak'
            ) DEFAULT 'pending'
        ");
    }
};
