<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamaran')->cascadeOnDelete();
            $table->enum('jenis', ['cv', 'surat_lamaran', 'ijazah_transkrip', 'sertifikat']);
            $table->string('nama_file');   // nama asli file
            $table->string('path_file');   // lokasi di storage
            $table->unsignedInteger('ukuran_kb')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_lamaran');
    }
};
