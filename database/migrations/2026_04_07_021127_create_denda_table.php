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
        Schema::create('denda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman_buku')->onDelete('cascade');
            $table->enum('jenis', ['terlambat', 'rusak', 'hilang']);
            $table->enum('tingkat_kerusakan', ['ringan','sedang','berat'])->nullable();
            $table->decimal('nominal', 12, 2)->nullable();
            $table->text('keterangan')->nullable();
            //status denda
            $table->enum('status', ['aktif', 'dibatalkan'])->default('aktif');
            $table->foreignId('denda_parent_id')->nullable()->constrained('denda')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
};
