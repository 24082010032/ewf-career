<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi', 30)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lowongan_id')->constrained('lowongan')->cascadeOnDelete();
            $table->foreignId('cabang_pilihan_id')->nullable()->constrained('cabang')->nullOnDelete();
            $table->enum('kesiapan_mulai', ['Segera', '1 Bulan', 'Awal Bulan Depan'])->default('Segera');
            $table->string('sumber_informasi', 60)->nullable();
            // tahap: 1 Berkas Masuk, 2 Administrasi, 3 Asesmen, 4 Wawancara, 5 Keputusan Akhir
            $table->unsignedTinyInteger('tahap')->default(1);
            $table->enum('status', ['menunggu', 'lolos_administrasi', 'asesmen', 'wawancara', 'diterima', 'ditolak'])
                  ->default('menunggu');
            $table->unsignedTinyInteger('skor_evaluasi')->nullable();
            $table->text('catatan_hrd')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'lowongan_id']); // cegah melamar dobel
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};
