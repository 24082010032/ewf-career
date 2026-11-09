<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wawancara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamaran')->cascadeOnDelete();
            $table->dateTime('waktu');
            $table->string('pewawancara', 100)->nullable();
            $table->string('media', 100)->nullable();            // Zoom / Google Meet / Tatap Muka
            $table->string('link_atau_ruang')->nullable();
            $table->boolean('dikonfirmasi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wawancara');
    }
};
