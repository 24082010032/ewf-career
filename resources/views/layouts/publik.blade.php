<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - EWF CAREER</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#001835',
                        'primary-container': '#142d4e',
                        secondary: '#3d6188',
                        'tertiary-fixed': '#ffb4c0',
                        'tertiary-fixed-dim': '#f0627c',
                        'on-tertiary-container': '#c23a56',
                        'primary-fixed-dim': '#b0c8f1',
                        surface: '#f9f9ff',
                        'surface-container-low': '#f1f3ff',
                        'surface-container': '#e8eeff',
                        'surface-container-high': '#e3e8f9',
                        'on-surface': '#161c27',
                        'on-surface-variant': '#44474e',
                        outline: '#74777f',
                        error: '#ba1a1a',
                        'error-container': '#ffdad6',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                },
            },
        };
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .faq-icon { transform: rotate(180deg); }
    </style>
</head>
<body class="bg-surface font-sans text-on-surface antialiased">

{{-- HEADER --}}
<header class="fixed top-0 inset-x-0 z-50 bg-surface/90 backdrop-blur-xl shadow-sm">
    <div class="h-20 max-w-6xl mx-auto px-6 flex items-center justify-between gap-6">
        <a href="{{ route('beranda') }}" class="flex items-center gap-3 shrink-0">
            <img src="{{ asset('images/logo-globe.png') }}" alt="Logo PT Equityworld Futures" class="h-11 w-auto">
            <span class="flex flex-col leading-tight">
                <span class="font-bold text-primary tracking-tight">EWF CAREER</span>
                <span class="text-xs text-on-surface-variant hidden sm:inline">PT Equityworld Futures Surabaya</span>
            </span>
        </a>

        <nav class="hidden lg:flex items-center gap-2 text-sm">
            <a href="{{ route('beranda') }}" class="px-4 py-2 rounded-lg bg-surface-container text-primary font-semibold">Beranda</a>
            <a href="{{ route('beranda') }}#lowongan-terbaru" class="px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface transition-colors">Lowongan Kerja</a>
            <a href="{{ route('beranda') }}#program-magang" class="px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface transition-colors">Program Magang</a>
            <a href="{{ route('beranda') }}#kontak" class="px-4 py-2 rounded-lg text-on-surface-variant hover:text-on-surface transition-colors">Kontak</a>
        </nav>

        <div class="flex items-center gap-2 shrink-0 text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-primary-container text-white font-semibold hover:bg-secondary transition-colors">Dasbor</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-secondary font-semibold hover:text-primary transition-colors">Keluar</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-secondary font-semibold hover:text-primary transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg bg-primary-container text-white font-semibold hover:bg-secondary transition-colors">Daftar Akun</a>
            @endguest
        </div>
    </div>
</header>

<main class="pt-20">
    @yield('content')
</main>

{{-- FOOTER --}}
@php $kantor = \App\Models\Cabang::first(); @endphp
<footer id="kontak" class="bg-surface-container-low mt-16">
    <div class="max-w-6xl mx-auto px-6 pt-12 pb-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-5">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo-globe.png') }}" alt="Logo PT Equityworld Futures" class="h-12 w-auto">
                    <span class="font-bold text-primary tracking-tight">EWF CAREER</span>
                </div>
                <p class="text-sm text-on-surface-variant leading-relaxed mb-4">
                    Portal rekrutmen PT Equityworld Futures Surabaya. Membangun profesionalitas berintegritas di industri perdagangan berjangka.
                </p>
                <div class="p-4 rounded-lg bg-white">
                    <p class="text-xs font-semibold uppercase tracking-wider text-on-tertiary-container mb-1">Pemberitahuan</p>
                    <p class="text-sm text-on-surface-variant">Seluruh proses seleksi tidak dipungut biaya apa pun.</p>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h3 class="font-semibold text-primary mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm text-on-surface-variant">
                    <li><a class="hover:text-on-surface" href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a class="hover:text-on-surface" href="{{ route('beranda') }}#lowongan-terbaru">Lowongan Kerja</a></li>
                    <li><a class="hover:text-on-surface" href="{{ route('beranda') }}#program-magang">Program Magang</a></li>
                    <li><a class="hover:text-on-surface" href="{{ route('login') }}">Masuk</a></li>
                </ul>
            </div>

            <div class="lg:col-span-4">
                <h3 class="font-semibold text-primary mb-4">Kantor Surabaya</h3>
                @if ($kantor)
                    <ul class="space-y-3 text-sm text-on-surface-variant">
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-secondary text-[20px]">apartment</span>
                            <span>{{ $kantor->alamat }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-secondary text-[20px]">call</span>
                            <span>{{ $kantor->telepon }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-secondary text-[20px]">schedule</span>
                            <span>{{ $kantor->jam_operasional }}</span>
                        </li>
                        @if ($kantor->url_peta)
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-secondary text-[20px]">pin_drop</span>
                                <a href="{{ $kantor->url_peta }}" target="_blank" rel="noopener" class="text-secondary font-semibold hover:text-primary">Lihat di Google Maps</a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-surface-container text-sm text-on-surface-variant">
            &copy; {{ date('Y') }} PT Equityworld Futures Surabaya. Hak cipta dilindungi.
        </div>
    </div>
</footer>

</body>
</html>
