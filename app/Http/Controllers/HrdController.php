<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;

class HrdController extends Controller
{
    public function dasbor()
    {
        $perStatus = Lamaran::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('dasbor.hrd', [
            'total'     => Lamaran::count(),
            'kerja'     => Lamaran::whereHas('lowongan', fn ($q) => $q->where('kategori', 'karier'))->count(),
            'magang'    => Lamaran::whereHas('lowongan', fn ($q) => $q->where('kategori', 'magang'))->count(),
            'perlu'     => Lamaran::whereIn('status', ['menunggu', 'ditinjau'])->count(),
            'perStatus' => $perStatus,
            'terbaru'   => Lamaran::with(['user', 'lowongan'])->latest()->take(8)->get(),
            'lowongan'  => Lowongan::withCount('lamaran')->aktif()->orderBy('batas_lamaran')->get(),
        ]);
    }
}
