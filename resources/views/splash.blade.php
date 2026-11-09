<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat... - EWF CAREER</title>
    <noscript><meta http-equiv="refresh" content="3;url={{ route('dashboard') }}"></noscript>

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
                        'tertiary-fixed': '#ffb4c0',
                        'tertiary-fixed-dim': '#f0627c',
                        'primary-fixed-dim': '#b0c8f1',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400; }
        @keyframes bar { from { width: 0%; } to { width: 100%; } }
        @keyframes pop { from { opacity: 0; transform: scale(.85); } to { opacity: 1; transform: scale(1); } }
        @keyframes fade-up { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .anim-bar { animation: bar 2.2s ease-in-out forwards; }
        .anim-pop { animation: pop .6s ease-out both; }
        .anim-up { animation: fade-up .7s ease-out .4s both; }
    </style>
</head>
<body class="bg-primary font-sans text-white antialiased">
<div id="layar" class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden transition-opacity duration-500">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-20%,rgba(174,210,255,0.18),rgba(0,24,53,0))] pointer-events-none"></div>
    <div class="absolute -right-24 -top-24 w-96 h-96 bg-tertiary-fixed/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative flex flex-col items-center text-center px-6">
        <img src="{{ asset('images/logo-globe.png') }}" alt="Logo PT Equityworld Futures" class="anim-pop h-28 w-auto drop-shadow-2xl">
        <h1 class="anim-up mt-6 text-3xl font-bold tracking-tight">EWF CAREER</h1>
        <p class="anim-up mt-1 text-sm text-primary-fixed-dim">PT Equityworld Futures Surabaya</p>

        <p class="anim-up mt-8 text-lg">
            Selamat datang, <span class="font-semibold text-tertiary-fixed">{{ Auth::user()->name }}</span>
        </p>

        <div class="anim-up mt-6 w-56 h-1 rounded-full bg-white/10 overflow-hidden">
            <div class="anim-bar h-full rounded-full bg-tertiary-fixed-dim"></div>
        </div>
        <p class="anim-up mt-3 text-xs text-white/50">Menyiapkan dasbor Anda...</p>
    </div>
</div>

<script>
    setTimeout(function () {
        document.getElementById('layar').style.opacity = '0';
        setTimeout(function () {
            window.location.replace("{{ route('dashboard') }}");
        }, 450);
    }, 2400);
</script>
</body>
</html>
