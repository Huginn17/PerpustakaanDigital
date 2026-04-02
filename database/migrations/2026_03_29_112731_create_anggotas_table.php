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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap')->nullable();
            $table->string('nomor_induk')->unique();
            $table->string('jenis_kelamin')->nullable();
            $table->integer('max_pinjam')->nullable();
            $table->integer('jumlah_pinjam_aktif')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
