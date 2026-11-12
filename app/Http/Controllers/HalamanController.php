<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\DataLowongan;
use App\Models\Cabang;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    use DataLowongan;

    public function tentang()
    {
        return view('tentang', [
            'kantor' => Cabang::first(),
            'total'  => Lowongan::aktif()->count(),
        ]);
    }

    public function lowongan(Request $request)
    {
        [$lowongan, $q, $kategori] = $this->cariLowongan($request);

        return view('lowongan', [
            'mode'     => 'semua',
            'lowongan' => $lowongan,
            'dataJs'   => $this->dataJs($lowongan),
            'q'        => $q,
            'kategori' => $kategori,
        ]);
    }

    public function magang(Request $request)
    {
        [$lowongan, $q, $kategori] = $this->cariLowongan($request, 'magang');

        return view('lowongan', [
            'mode'     => 'magang',
            'lowongan' => $lowongan,
            'dataJs'   => $this->dataJs($lowongan),
            'q'        => $q,
            'kategori' => 'magang',
        ]);
    }

    public function legalitas()
    {
        return view('legalitas');
    }
}
