<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;

class PelamarController extends Controller
{
    public function dasbor()
    {
        $user = auth()->user();

        $lamaran = Lamaran::with('lowongan.cabang')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $kerja  = $lamaran->filter(fn ($l) => $l->lowongan?->kategori === 'karier')->values();
        $magang = $lamaran->filter(fn ($l) => $l->lowongan?->kategori === 'magang')->values();

        // Kelengkapan profil
        $kolom = ['nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'status_pernikahan',
                  'alamat_domisili', 'no_whatsapp', 'jenjang', 'institusi', 'jurusan', 'ipk', 'tahun_lulus'];
        $profil = $user->profil;
        $terisi = 0;
        foreach ($kolom as $k) {
            if ($profil && filled($profil->{$k})) {
                $terisi++;
            }
        }
        $persen = (int) round($terisi / count($kolom) * 100);

        return view('dasbor.pelamar', [
            'kerja'    => $kerja,
            'magang'   => $magang,
            'persen'   => $persen,
            'diproses' => $lamaran->whereIn('status', ['menunggu', 'ditinjau', 'lolos_administrasi', 'tahap_seleksi'])->count(),
            'diterima' => $lamaran->where('status', 'diterima')->count(),
        ]);
    }
}
