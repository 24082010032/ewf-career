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
            // Satu tabel dipakai untuk lamaran kerja DAN pendaftaran magang
            // (jenisnya ditentukan oleh kolom "kategori" di tabel lowongan).
            $table->foreignId('lowongan_id')->constrained('lowongan')->cascadeOnDelete();
            $table->foreignId('cabang_pilihan_id')->nullable()->constrained('cabang')->nullOnDelete();
            $table->enum('kesiapan_mulai', ['Segera', '1 Bulan', 'Awal Bulan Depan'])->default('Segera');
            $table->string('sumber_informasi', 60)->nullable();
            $table->enum('status', [
                'menunggu',            // pendaftaran baru masuk
                'ditinjau',            // dokumen sedang diperiksa HRD
                'lolos_administrasi',  // lolos pemeriksaan dokumen
                'tidak_lolos',         // tidak memenuhi kriteria
                'tahap_seleksi',       // mengikuti tahapan seleksi berikutnya
                'diterima',            // dinyatakan diterima
            ])->default('menunggu');
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
