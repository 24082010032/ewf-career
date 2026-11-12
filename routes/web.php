<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ---------- Halaman yang bisa dibuka siapa saja ----------
Route::get('/', [BerandaController::class, 'publik'])->name('beranda');
Route::get('/tentang', [HalamanController::class, 'tentang'])->name('tentang');
Route::get('/lowongan', [HalamanController::class, 'lowongan'])->name('lowongan');
Route::get('/program-magang', [HalamanController::class, 'magang'])->name('magang');
Route::get('/legalitas', [HalamanController::class, 'legalitas'])->name('legalitas');

// ---------- Halaman yang WAJIB login ----------
Route::middleware('auth')->group(function () {
    // Splash screen setelah login berhasil
    Route::get('/memuat', fn () => view('splash'))->name('splash');

    // Beranda utama (informasi lengkap)
    Route::get('/beranda', [BerandaController::class, 'utama'])->name('home');

    // Alamat lama bawaan Breeze diarahkan ke Beranda utama
    Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
