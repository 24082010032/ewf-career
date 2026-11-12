<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - EWF CAREER</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: '#001835', 'primary-container': '#142d4e', secondary: '#3d6188',
                    'tertiary-fixed': '#ffb4c0', 'tertiary-fixed-dim': '#f0627c', 'on-tertiary-container': '#c23a56',
                    surface: '#f9f9ff', 'surface-container-low': '#f1f3ff', 'surface-container': '#e8eeff',
                    'on-surface': '#161c27', 'on-surface-variant': '#44474e', outline: '#74777f',
                    error: '#ba1a1a', 'error-container': '#ffdad6',
                },
                fontFamily: { sans: ['Inter', 'sans-serif'] },
            } },
        };
    </script>
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400; } .fill { font-variation-settings: 'FILL' 1, 'wght' 400; }</style>
</head>
<body class="bg-surface font-sans text-on-surface antialiased">
<div class="min-h-screen flex">

    {{-- Panel kiri (putih) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-white border-r border-surface-container p-12 flex-col justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-3 self-start">
            <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="h-16 w-auto">
            <span class="flex flex-col leading-tight">
                <span class="font-extrabold text-primary tracking-tight text-lg">EWF CAREER</span>
                <span class="text-xs text-on-surface-variant">PT Equityworld Futures Surabaya</span>
            </span>
        </a>

        <div class="space-y-6 max-w-md">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container text-primary text-xs font-semibold uppercase tracking-wide">
                <span class="w-2 h-2 rounded-full bg-tertiary-fixed-dim animate-pulse"></span> Portal Resmi Rekrutmen
            </span>
            <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-primary">Masuk dan pantau progres seleksi kariermu.</h1>
            <p class="text-on-surface-variant leading-relaxed">Lihat seluruh lowongan, kualifikasi, dan program magang dalam satu portal.</p>
            <div class="rounded-2xl overflow-hidden shadow-xl">
                <img src="{{ asset('images/gedung-trillium.jpg') }}" alt="Gedung kantor Surabaya" class="w-full h-56 object-cover">
            </div>
        </div>

        <div class="flex items-center gap-3 text-sm text-on-surface-variant">
            <span class="material-symbols-outlined text-on-tertiary-container fill text-[20px]">verified_user</span>
            <span>Seluruh proses seleksi 100% bebas biaya.</span>
        </div>
    </div>

    {{-- Panel kanan (formulir) --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            <a href="{{ url('/') }}" class="lg:hidden flex items-center gap-3 mb-8">
                <img src="{{ asset('images/logo-ewf.png') }}" alt="Logo PT Equityworld Futures" class="h-12 w-auto">
                <span class="font-extrabold text-primary tracking-tight">EWF CAREER</span>
            </a>

            <h2 class="text-3xl font-extrabold text-primary tracking-tight">Masuk ke Akun</h2>
            <p class="mt-2 text-on-surface-variant">Silakan masukkan email dan kata sandi Anda.</p>

            @if (request('terkunci'))
                <div class="mt-6 p-3 rounded-lg bg-surface-container text-primary text-sm flex items-start gap-2">
                    <span class="material-symbols-outlined fill text-[20px] text-on-tertiary-container">lock</span>
                    <span>Silakan masuk atau <a href="{{ route('register') }}" class="font-semibold underline">daftar akun</a> untuk melihat detail lowongan dan melamar.</span>
                </div>
            @endif

            @if (session('status'))
                <div class="mt-6 p-3 rounded-lg bg-surface-container text-primary text-sm">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-6 p-3 rounded-lg bg-error-container text-error text-sm flex items-start gap-2">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-primary">Email</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">mail</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="nama@email.com"
                               class="w-full h-12 pl-11 pr-3 rounded-lg bg-white border border-surface-container text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary transition">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-primary">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-secondary hover:text-primary font-medium">Lupa kata sandi?</a>
                        @endif
                    </div>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">lock</span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               placeholder="Masukkan kata sandi"
                               class="w-full h-12 pl-11 pr-12 rounded-lg bg-white border border-surface-container text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary transition">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 text-outline hover:text-primary" aria-label="Tampilkan kata sandi">
                            <span id="eye-icon" class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-on-surface-variant cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-primary"> Ingat saya
                </label>

                <button type="submit" class="w-full h-12 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors shadow-md flex items-center justify-center gap-2">
                    <span>Masuk</span><span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
            </form>

            @if (Route::has('register'))
                <p class="mt-8 text-center text-sm text-on-surface-variant">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-secondary hover:text-primary">Daftar Akun</a>
                </p>
            @endif
            <p class="mt-4 text-center text-sm"><a href="{{ url('/') }}" class="text-on-surface-variant hover:text-primary">&larr; Kembali ke Beranda</a></p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var input = document.getElementById('password'), icon = document.getElementById('eye-icon');
        var tersembunyi = input.type === 'password';
        input.type = tersembunyi ? 'text' : 'password';
        icon.textContent = tersembunyi ? 'visibility_off' : 'visibility';
    }
</script>
</body>
</html>
