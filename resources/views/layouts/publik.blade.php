<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - EWF CAREER</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1, 'wght' 400; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .faq-icon { transform: rotate(180deg); }

        /* Teks berjalan */
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track { display: flex; width: max-content; animation: marquee 38s linear infinite; }
        .marquee:hover .marquee-track { animation-play-state: paused; }

        /* Muncul halus saat di-scroll */
        .reveal { opacity: 0; transform: translateY(18px); transition: opacity .7s ease, transform .7s ease; }
        .reveal.tampil { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            .marquee-track { animation: none; }
        }
    </style>
    @stack('head')
</head>
<body class="bg-surface font-sans text-on-surface antialiased">

@php
    $masuk = auth()->check();

    // [label, alamat, aktif?] - setiap menu adalah halaman sendiri
    $nav = [
        ['Beranda',        $masuk ? route('home') : route('beranda'), request()->routeIs('beranda', 'home')],
        ['Tentang',        route('tentang'),   request()->routeIs('tentang')],
        ['Lowongan',       route('lowongan'),  request()->routeIs('lowongan')],
        ['Program Magang', route('magang'),    request()->routeIs('magang')],
        ['Legalitas',      route('legalitas'), request()->routeIs('legalitas')],
    ];
@endphp

{{-- HEADER (latar putih) --}}
<header class="fixed top-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-b border-surface-container">
    <div class="h-20 max-w-6xl mx-auto px-6 flex items-center justify-between gap-6">
        <a href="{{ $masuk ? route('home') : route('beranda') }}" class="flex items-center gap-3 shrink-0">
            <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="h-12 w-auto">
            <span class="flex flex-col leading-tight">
                <span class="font-extrabold text-primary tracking-tight">EWF CAREER</span>
                <span class="text-xs text-on-surface-variant hidden sm:inline">PT Equityworld Futures Surabaya</span>
            </span>
        </a>

        <nav class="hidden lg:flex items-center gap-1 text-sm">
            @foreach ($nav as [$label, $url, $aktif])
                <a href="{{ $url }}"
                   class="px-4 py-2 rounded-lg transition-colors {{ $aktif ? 'bg-surface-container text-primary font-semibold' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container-low' }}">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 shrink-0 text-sm">
            @auth
                <span class="hidden sm:flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-surface-container-low">
                    <span class="w-8 h-8 rounded-full bg-primary text-white grid place-items-center text-sm font-bold">{{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="font-semibold text-primary">{{ \Illuminate\Support\Str::words(auth()->user()->name, 1, '') }}</span>
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg text-on-tertiary-container font-semibold hover:bg-error-container/60 transition-colors">Keluar</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-secondary font-semibold hover:text-primary transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors shadow-sm">Daftar Akun</a>
            @endguest

            <button type="button" id="menu-btn" class="lg:hidden w-10 h-10 grid place-items-center rounded-lg hover:bg-surface-container-low" aria-label="Menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div id="menu-mobile" class="hidden lg:hidden border-t border-surface-container bg-white px-6 py-3">
        @foreach ($nav as [$label, $url, $aktif])
            <a href="{{ $url }}" class="block py-2.5 font-medium {{ $aktif ? 'text-primary font-semibold' : 'text-on-surface-variant' }}">{{ $label }}</a>
        @endforeach
    </div>
</header>

<main class="pt-20">
    @yield('content')
</main>

{{-- FOOTER (latar putih) --}}
@php $kantorFooter = \App\Models\Cabang::first(); @endphp
<footer id="kontak" class="bg-white border-t border-surface-container mt-16 scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 pt-12 pb-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-5">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="h-14 w-auto">
                    <span class="font-extrabold text-primary tracking-tight">EWF CAREER</span>
                </div>
                <p class="text-sm text-on-surface-variant leading-relaxed mb-4">
                    Portal rekrutmen PT Equityworld Futures Surabaya. Membangun profesionalitas berintegritas di industri perdagangan berjangka.
                </p>
                <div class="p-4 rounded-lg bg-surface-container-low">
                    <p class="text-xs font-semibold uppercase tracking-wider text-on-tertiary-container mb-1">Pemberitahuan</p>
                    <p class="text-sm text-on-surface-variant">Seluruh proses seleksi tidak dipungut biaya apa pun.</p>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h3 class="font-semibold text-primary mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm text-on-surface-variant">
                    @foreach ($nav as [$label, $url, $aktif])
                        <li><a class="hover:text-primary" href="{{ $url }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-4">
                <h3 class="font-semibold text-primary mb-4">Kantor Surabaya</h3>
                @if ($kantorFooter)
                    <ul class="space-y-3 text-sm text-on-surface-variant">
                        <li class="flex items-start gap-2"><span class="material-symbols-outlined text-secondary text-[20px]">apartment</span><span>{{ $kantorFooter->alamat }}</span></li>
                        <li class="flex items-start gap-2"><span class="material-symbols-outlined text-secondary text-[20px]">call</span><span>{{ $kantorFooter->telepon }}</span></li>
                        <li class="flex items-start gap-2"><span class="material-symbols-outlined text-secondary text-[20px]">schedule</span><span>{{ $kantorFooter->jam_operasional }}</span></li>
                        @if ($kantorFooter->url_peta)
                            <li class="flex items-start gap-2"><span class="material-symbols-outlined text-secondary text-[20px]">pin_drop</span>
                                <a href="{{ $kantorFooter->url_peta }}" target="_blank" rel="noopener" class="text-secondary font-semibold hover:text-primary">Lihat di Google Maps</a></li>
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

<script>
    // Menu mobile
    (function () {
        var btn = document.getElementById('menu-btn'), menu = document.getElementById('menu-mobile');
        if (btn && menu) btn.addEventListener('click', function () { menu.classList.toggle('hidden'); });
    })();

    // Muncul halus saat di-scroll
    (function () {
        var els = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('tampil'); }); return; }
        var io = new IntersectionObserver(function (items) {
            items.forEach(function (it) { if (it.isIntersecting) { it.target.classList.add('tampil'); io.unobserve(it.target); } });
        }, { threshold: 0.12 });
        els.forEach(function (e) { io.observe(e); });
    })();
</script>
@stack('scripts')
</body>
</html>
