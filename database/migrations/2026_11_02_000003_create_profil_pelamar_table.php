<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            // Data pribadi (Tahap 1 formulir)
            $table->char('nik', 16)->nullable();
            $table->string('tempat_lahir', 80)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Lainnya'])->default('Belum Menikah');
            $table->text('alamat_domisili')->nullable();
            $table->string('no_whatsapp', 20)->nullable();
            // Pendidikan (Tahap 2 formulir)
            $table->enum('jenjang', ['SMA/SMK', 'D3', 'S1', 'S2'])->nullable();
            $table->string('institusi', 150)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('pengalaman_organisasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_pelamar');
    }
};
