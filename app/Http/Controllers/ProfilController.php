<?php

namespace App\Http\Controllers;

use App\Models\ProfilPelamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function edit(Request $request)
    {
        return view('profil', [
            'user'   => $request->user(),
            'profil' => $request->user()->profil,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $aturan = [
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:120', Rule::unique('users', 'email')->ignore($user->id)],
        ];

        // Data diri hanya untuk Pelamar
        if ($user->isPelamar()) {
            $aturan += [
                'nik'                   => ['nullable', 'digits:16'],
                'tempat_lahir'          => ['nullable', 'string', 'max:80'],
                'tanggal_lahir'         => ['nullable', 'date', 'before:today'],
                'jenis_kelamin'         => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
                'status_pernikahan'     => ['nullable', Rule::in(['Belum Menikah', 'Menikah', 'Lainnya'])],
                'alamat_domisili'       => ['nullable', 'string', 'max:500'],
                'no_whatsapp'           => ['nullable', 'regex:/^[0-9+\-\s]{8,20}$/'],
                'jenjang'               => ['nullable', Rule::in(['SMA/SMK', 'D3', 'S1', 'S2'])],
                'institusi'             => ['nullable', 'string', 'max:150'],
                'jurusan'               => ['nullable', 'string', 'max:100'],
                'ipk'                   => ['nullable', 'numeric', 'between:0,4'],
                'tahun_lulus'           => ['nullable', 'integer', 'between:1990,' . (date('Y') + 6)],
                'pengalaman_organisasi' => ['nullable', 'string', 'max:255'],
            ];
        }

        $data = $request->validate($aturan, [
            'nik.digits'           => 'NIK harus 16 digit angka.',
            'no_whatsapp.regex'    => 'Nomor WhatsApp hanya boleh berisi angka, spasi, tanda + dan -.',
            'ipk.between'          => 'IPK harus di antara 0 dan 4.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'email.unique'         => 'Email ini sudah dipakai akun lain.',
        ]);

        $user->update(['name' => $data['name'], 'email' => $data['email']]);

        if ($user->isPelamar()) {
            unset($data['name'], $data['email']);
            ProfilPelamar::updateOrCreate(['user_id' => $user->id], $data);
        }

        return redirect()->route('profil')->with('status', 'profil-tersimpan');
    }
}
