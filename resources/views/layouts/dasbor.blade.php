<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dasbor') - EWF CAREER</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: '#001835', 'primary-container': '#142d4e', secondary: '#3d6188',
                    'tertiary-fixed': '#ffb4c0', 'tertiary-fixed-dim': '#f0627c', 'on-tertiary-container': '#c23a56',
                    'primary-fixed-dim': '#b0c8f1',
                    surface: '#f9f9ff', 'surface-container-low': '#f1f3ff', 'surface-container': '#e8eeff', 'surface-container-high': '#e3e8f9',
                    'on-surface': '#161c27', 'on-surface-variant': '#44474e', outline: '#74777f',
                    error: '#ba1a1a', 'error-container': '#ffdad6',
                },
                fontFamily: { sans: ['Inter', 'sans-serif'] },
            } },
        };
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400; }
        .fill { font-variation-settings: 'FILL' 1, 'wght' 400; }
    </style>
    @stack('head')
</head>
<body class="bg-surface font-sans text-on-surface antialiased">
@php
    $u    = auth()->user();
    $role = $u->role;

    // [label, ikon, alamat (null = belum tersedia), aktif?]
    $menu = match ($role) {
        'admin' => [
            ['Dasbor',            'dashboard',            route('admin.dasbor'), request()->routeIs('admin.dasbor')],
            ['Kelola Akun',       'manage_accounts',      null, false],
            ['Kelola Role',       'admin_panel_settings', null, false],
            ['Kelola HRD',        'badge',                null, false],
            ['Profil Perusahaan', 'business',             null, false],
            ['Konten Website',    'article',              null, false],
            ['Laporan',           'assessment',           null, false],
            ['Profil Saya',       'person',               route('profil'), request()->routeIs('profil')],
        ],
        'hrd' => [
            ['Dasbor',            'dashboard',            route('hrd.dasbor'), request()->routeIs('hrd.dasbor')],
            ['Lowongan Kerja',    'work',                 null, false],
            ['Program Magang',    'school',               null, false],
            ['Data Pelamar',      'groups',               null, false],
            ['Dokumen Pelamar',   'folder_shared',        null, false],
            ['Seleksi & Status',  'fact_check',           null, false],
            ['Pengumuman',        'campaign',             null, false],
            ['Profil Saya',       'person',               route('profil'), request()->routeIs('profil')],
        ],
        default => [
            ['Dasbor',            'dashboard',            route('pelamar.dasbor'), request()->routeIs('pelamar.dasbor')],
            ['Daftar Lowongan',   'work',                 route('lowongan'), false],
            ['Program Magang',    'school',               route('magang'), false],
            ['Lamaran Saya',      'description',          route('pelamar.dasbor') . '#lamaran-saya', false],
            ['Status Seleksi',    'fact_check',           route('pelamar.dasbor') . '#status-seleksi', false],
            ['Profil Saya',       'person',               route('profil'), request()->routeIs('profil')],
        ],
    };
@endphp

{{-- Bilah atas --}}
<header class="fixed top-0 inset-x-0 z-40 h-16 bg-white border-b border-surface-container flex items-center justify-between px-4 lg:px-6">
    <a href="{{ $u->landingUrl() }}" class="flex items-center gap-3">
        <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="h-10 w-auto">
        <span class="flex flex-col leading-tight">
            <span class="font-extrabold text-primary tracking-tight">EWF CAREER</span>
            <span class="text-[11px] text-on-surface-variant">{{ $u->roleLabel() }}</span>
        </span>
    </a>
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('tentang') }}" class="hidden md:inline px-3 py-2 rounded-lg text-on-surface-variant hover:bg-surface-container-low">Lihat Website</a>
        <a href="{{ route('profil') }}" class="hidden sm:flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-surface-container-low hover:bg-surface-container transition-colors">
            <span class="w-8 h-8 rounded-full bg-primary text-white grid place-items-center text-sm font-bold">{{ strtoupper(mb_substr($u->name, 0, 1)) }}</span>
            <span class="font-semibold text-primary">{{ \Illuminate\Support\Str::words($u->name, 1, '') }}</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg text-on-tertiary-container font-semibold hover:bg-error-container/60 transition-colors">Keluar</button>
        </form>
    </div>
</header>

<div class="pt-16 lg:pl-64">
    {{-- Menu samping --}}
    <aside class="hidden lg:flex fixed left-0 top-16 bottom-0 w-64 bg-white border-r border-surface-container flex-col p-4 gap-1 overflow-y-auto">
        <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-outline">Menu {{ $u->roleLabel() }}</p>
        @foreach ($menu as [$label, $ikon, $url, $aktif])
            @if ($url)
                <a href="{{ $url }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors {{ $aktif ? 'bg-primary text-white font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $ikon }}</span>{{ $label }}
                </a>
            @else
                <div class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm text-outline cursor-not-allowed" title="Fitur ini segera hadir">
                    <span class="flex items-center gap-3"><span class="material-symbols-outlined text-[20px]">{{ $ikon }}</span>{{ $label }}</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-surface-container text-on-surface-variant">Segera</span>
                </div>
            @endif
        @endforeach
    </aside>

    {{-- Menu versi HP --}}
    <nav class="lg:hidden bg-white border-b border-surface-container px-4 py-2 flex gap-2 overflow-x-auto text-sm">
        @foreach ($menu as [$label, $ikon, $url, $aktif])
            @if ($url)
                <a href="{{ $url }}" class="shrink-0 px-3 py-1.5 rounded-full {{ $aktif ? 'bg-primary text-white font-semibold' : 'bg-surface-container-low text-on-surface-variant' }}">{{ $label }}</a>
            @endif
        @endforeach
    </nav>

    <main class="p-4 lg:p-8 max-w-6xl">
        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
