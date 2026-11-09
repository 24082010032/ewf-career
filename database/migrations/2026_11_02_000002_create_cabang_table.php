<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kota', 60);
            $table->string('alamat')->nullable();
            $table->string('telepon', 60)->nullable();
            $table->string('jam_operasional', 100)->nullable();
            $table->text('url_peta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};