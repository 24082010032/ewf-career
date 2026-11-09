<?php

use App\Http\Controllers\ProfileController;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Route;

// Beranda publik (sebelum login)
Route::get('/', function () {
    $lowongan = Lowongan::with('cabang')
        ->aktif()
        ->orderBy('batas_lamaran')
        ->take(3)
        ->get();

    return view('beranda', [
        'lowongan'    => $lowongan,
        'total'       => Lowongan::aktif()->count(),
        'totalMagang' => Lowongan::aktif()->where('kategori', 'magang')->count(),
    ]);
})->name('beranda');

// Splash screen setelah login berhasil
Route::get('/memuat', function () {
    return view('splash');
})->middleware('auth')->name('splash');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
