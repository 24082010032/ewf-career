<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat... - EWF CAREER</title>
    <noscript><meta http-equiv="refresh" content="3;url={{ route('home') }}"></noscript>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { primary: '#001835', secondary: '#3d6188', 'tertiary-fixed': '#ffb4c0', 'tertiary-fixed-dim': '#f0627c', 'surface-container': '#e8eeff' },
                fontFamily: { sans: ['Inter', 'sans-serif'] },
            } },
        };
    </script>
    <style>
        @keyframes bar { from { width: 0%; } to { width: 100%; } }
        @keyframes pop { from { opacity: 0; transform: scale(.8); } to { opacity: 1; transform: scale(1); } }
        @keyframes up { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .anim-bar { animation: bar 2.2s ease-in-out forwards; }
        .anim-pop { animation: pop .7s cubic-bezier(.2,.8,.2,1) both, float 3s ease-in-out .8s infinite; }
        .anim-up { animation: up .7s ease-out .4s both; }
    </style>
</head>
<body class="bg-white font-sans text-primary antialiased">
<div id="layar" class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden transition-opacity duration-500">
    <div class="absolute -left-24 -top-24 w-96 h-96 rounded-full bg-tertiary-fixed/20 blur-3xl"></div>
    <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-surface-container blur-3xl"></div>

    <div class="relative flex flex-col items-center text-center px-6">
        <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="anim-pop h-40 w-auto">
        <h1 class="anim-up mt-6 text-3xl font-extrabold tracking-tight">EWF CAREER</h1>
        <p class="anim-up mt-1 text-sm text-secondary">PT Equityworld Futures Surabaya</p>

        <p class="anim-up mt-8 text-lg text-slate-600">
            Selamat datang, <span class="font-bold text-tertiary-fixed-dim">{{ Auth::user()->name }}</span>
        </p>

        <div class="anim-up mt-6 w-56 h-1.5 rounded-full bg-surface-container overflow-hidden">
            <div class="anim-bar h-full rounded-full bg-tertiary-fixed-dim"></div>
        </div>
        <p class="anim-up mt-3 text-xs text-slate-400">Menyiapkan beranda Anda...</p>
    </div>
</div>

<script>
    setTimeout(function () {
        document.getElementById('layar').style.opacity = '0';
        setTimeout(function () { window.location.replace("{{ route('home') }}"); }, 450);
    }, 2400);
</script>
</body>
</html>
