<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ref', 30)->unique();
            $table->string('judul', 150);
            $table->enum('kategori', ['karier', 'magang']);
            $table->string('departemen', 100)->nullable();
            $table->enum('tipe', ['Full Time', 'Magang', 'Kontrak'])->default('Full Time');
            $table->foreignId('cabang_id')->nullable()->constrained('cabang')->nullOnDelete();
            $table->text('deskripsi')->nullable();
            $table->text('tanggung_jawab')->nullable();
            $table->text('kualifikasi')->nullable();
            $table->text('benefit')->nullable();
            $table->string('min_pengalaman', 50)->nullable();
            $table->date('batas_lamaran');
            $table->enum('status', ['buka', 'tutup'])->default('buka');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
