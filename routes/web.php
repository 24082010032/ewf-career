<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Middleware\EnsureRole;
use Illuminate\Support\Facades\Route;

// ---------- Halaman yang bisa dibuka siapa saja ----------
Route::get('/', [BerandaController::class, 'publik'])->name('beranda');
Route::get('/tentang', [HalamanController::class, 'tentang'])->name('tentang');
Route::get('/lowongan', [HalamanController::class, 'lowongan'])->name('lowongan');
Route::get('/program-magang', [HalamanController::class, 'magang'])->name('magang');
Route::get('/legalitas', [HalamanController::class, 'legalitas'])->name('legalitas');

// ---------- Halaman yang WAJIB login (semua role) ----------
Route::middleware('auth')->group(function () {
    Route::get('/memuat', fn () => view('splash'))->name('splash');
    Route::get('/beranda', [BerandaController::class, 'utama'])->name('home');

    // Alamat lama bawaan Breeze: diarahkan ke dasbor sesuai role
    Route::get('/dashboard', fn () => redirect(auth()->user()->dashboardUrl()))->name('dashboard');

    // Profil pengguna
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Bawaan Breeze (hapus akun dll.)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------- Dasbor per role ----------
Route::middleware(['auth', EnsureRole::class . ':pelamar'])->group(function () {
    Route::get('/dasbor', [PelamarController::class, 'dasbor'])->name('pelamar.dasbor');
});

Route::middleware(['auth', EnsureRole::class . ':hrd'])->group(function () {
    Route::get('/hrd', [HrdController::class, 'dasbor'])->name('hrd.dasbor');
});

Route::middleware(['auth', EnsureRole::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dasbor'])->name('admin.dasbor');
});

require __DIR__.'/auth.php';
