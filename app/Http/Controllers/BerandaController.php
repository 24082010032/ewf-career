<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\DataLowongan;
use App\Models\Cabang;
use App\Models\Lowongan;

class BerandaController extends Controller
{
    use DataLowongan;

    /**
     * Beranda publik (sebelum login): cuplikan informasi.
     */
    public function publik()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('beranda', [
            'cuplikan'    => Lowongan::with('cabang')->aktif()->orderBy('batas_lamaran')->take(3)->get(),
            'total'       => Lowongan::aktif()->count(),
            'totalMagang' => Lowongan::aktif()->where('kategori', 'magang')->count(),
        ]);
    }

    /**
     * Beranda utama (setelah login): informasi lengkap.
     */
    public function utama()
    {
        $terbaru = Lowongan::with('cabang')->aktif()->orderBy('batas_lamaran')->take(3)->get();

        return view('home', [
            'terbaru'     => $terbaru,
            'dataJs'      => $this->dataJs($terbaru),
            'totalAktif'  => Lowongan::aktif()->count(),
            'totalKarier' => Lowongan::aktif()->where('kategori', 'karier')->count(),
            'totalMagang' => Lowongan::aktif()->where('kategori', 'magang')->count(),
            'kantor'      => Cabang::first(),
        ]);
    }
}
