<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->onDelete('cascade');
            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->date('tanggal_kembalikan')->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan','menunggu_konfirmasi','', 'pending', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_buku');
    }
};
