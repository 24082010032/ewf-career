<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\User;

class AdminController extends Controller
{
    public function dasbor()
    {
        $perRole = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');

        return view('dasbor.admin', [
            'totalAkun'   => User::count(),
            'perRole'     => $perRole,
            'lowongan'    => Lowongan::aktif()->count(),
            'pendaftaran' => Lamaran::count(),
            'akunTerbaru' => User::latest()->take(8)->get(),
        ]);
    }
}
