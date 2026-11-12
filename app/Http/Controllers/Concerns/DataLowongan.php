<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Lowongan;
use Illuminate\Http\Request;

trait DataLowongan
{
    /**
     * Ambil lowongan aktif, dengan pencarian kata kunci dan kategori.
     * Mengembalikan [koleksi lowongan, kata kunci, kategori].
     */
    protected function cariLowongan(Request $request, ?string $kategoriPaksa = null): array
    {
        $q        = trim((string) $request->query('q', ''));
        $kategori = $kategoriPaksa ?? $request->query('kategori');

        $lowongan = Lowongan::with('cabang')
            ->aktif()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('judul', 'like', "%{$q}%")
                      ->orWhere('departemen', 'like', "%{$q}%")
                      ->orWhere('deskripsi', 'like', "%{$q}%");
                });
            })
            ->when(in_array($kategori, ['karier', 'magang'], true), function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            })
            ->orderBy('batas_lamaran')
            ->get();

        return [$lowongan, $q, $kategori];
    }

    /**
     * Data untuk jendela "Lihat Detail" (dibaca oleh JavaScript).
     */
    protected function dataJs($lowongan)
    {
        return $lowongan->map(function ($l) {
            return [
                'id'         => $l->id,
                'judul'      => $l->judul,
                'kategori'   => $l->kategori === 'magang' ? 'Program Magang' : 'Karier Profesional',
                'tipe'       => $l->tipe,
                'departemen' => $l->departemen,
                'lokasi'     => $l->cabang->nama ?? 'Surabaya',
                'alamat'     => $l->cabang->alamat ?? '',
                'deskripsi'  => $l->deskripsi,
                'pengalaman' => $l->min_pengalaman,
                'batas'      => $l->batas_lamaran->locale('id')->translatedFormat('d F Y'),
                'sisa'       => (int) now()->startOfDay()->diffInDays($l->batas_lamaran->startOfDay(), false),
            ];
        })->values();
    }
}
