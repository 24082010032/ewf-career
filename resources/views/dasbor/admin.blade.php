@extends('layouts.dasbor')

@section('title', 'Dasbor Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-primary tracking-tight">Dasbor Admin</h1>
    <p class="text-on-surface-variant mt-1">Ringkasan sistem dan akun pengguna.</p>
</div>

<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach ([
        ['group', 'Total Akun', $totalAkun],
        ['admin_panel_settings', 'Admin', $perRole['admin'] ?? 0],
        ['badge', 'HRD', $perRole['hrd'] ?? 0],
        ['person', 'Pelamar', $perRole['pelamar'] ?? 0],
        ['work', 'Lowongan Aktif', $lowongan],
    ] as [$ik, $lb, $n])
        <div class="p-5 rounded-2xl bg-white shadow-sm border border-surface-container">
            <span class="w-10 h-10 rounded-xl bg-surface-container grid place-items-center text-primary mb-3"><span class="material-symbols-outlined">{{ $ik }}</span></span>
            <div class="text-3xl font-extrabold text-primary leading-none">{{ $n }}</div>
            <div class="text-xs text-on-surface-variant mt-1">{{ $lb }}</div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <section class="lg:col-span-2 p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
        <h2 class="font-bold text-primary text-lg mb-4">Akun Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs uppercase text-on-surface-variant bg-surface-container-low">
                        <th class="py-2.5 px-3 rounded-l-lg">Nama</th><th class="py-2.5 px-3">Email</th><th class="py-2.5 px-3 rounded-r-lg">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($akunTerbaru as $a)
                        <tr class="border-b border-surface-container last:border-0">
                            <td class="py-3 px-3 font-semibold text-primary">{{ $a->name }}</td>
                            <td class="py-3 px-3 text-on-surface-variant">{{ $a->email }}</td>
                            <td class="py-3 px-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $a->role === 'admin' ? 'bg-primary text-white' : ($a->role === 'hrd' ? 'bg-violet-100 text-violet-800' : 'bg-emerald-100 text-emerald-800') }}">{{ $a->roleLabel() }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-xs text-on-surface-variant mt-4">Tambah, ubah, dan nonaktifkan akun akan ditambahkan di tahap berikutnya.</p>
    </section>

    <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
        <h2 class="font-bold text-primary text-lg mb-4">Aktivitas Sistem</h2>
        <div class="p-4 rounded-xl bg-surface-container-low mb-3">
            <div class="text-3xl font-extrabold text-primary leading-none">{{ $pendaftaran }}</div>
            <div class="text-xs text-on-surface-variant mt-1">Total pendaftaran (kerja &amp; magang)</div>
        </div>
        <ul class="space-y-2 text-sm text-on-surface-variant">
            @foreach (['Kelola akun dan role', 'Profil perusahaan', 'Konten website', 'Laporan aktivitas'] as $f)
                <li class="flex items-center justify-between p-3 rounded-lg bg-surface-container-low">
                    <span>{{ $f }}</span><span class="text-[10px] px-1.5 py-0.5 rounded bg-white text-on-surface-variant">Segera</span>
                </li>
            @endforeach
        </ul>
    </section>
</div>
@endsection
