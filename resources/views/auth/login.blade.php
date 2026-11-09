<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - EWF CAREER</title>

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
                        surface: '#f9f9ff',
                        'surface-container-low': '#f1f3ff',
                        'surface-container': '#e8eeff',
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400; }
    </style>
</head>
<body class="bg-surface font-sans text-on-surface antialiased">
<div class="min-h-screen flex">

    {{-- Panel kiri (branding + foto gedung) --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary text-white p-12 flex-col justify-between">
        <div class="absolute inset-0 bg-cover bg-center opacity-40"
             style="background-image: url('{{ asset('images/gedung-trillium.jpg') }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-primary/80 via-primary/70 to-primary"></div>

        <a href="{{ url('/') }}" class="relative z-10 self-start flex items-center gap-3">
            <img src="{{ asset('images/logo-globe.png') }}" alt="Logo PT Equityworld Futures" class="h-14 w-auto">
            <span class="flex flex-col leading-tight">
                <span class="font-bold tracking-tight text-lg">EWF CAREER</span>
                <span class="text-xs text-white/60">PT Equityworld Futures Surabaya</span>
            </span>
        </a>

        <div class="relative z-10 space-y-5 max-w-md">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-tertiary-fixed text-xs font-semibold uppercase tracking-wide">
                <span class="w-2 h-2 rounded-full bg-tertiary-fixed animate-pulse"></span>
                Portal Resmi Rekrutmen
            </span>
            <h1 class="text-4xl font-bold leading-tight tracking-tight">
                Masuk dan pantau progres seleksi kariermu.
            </h1>
            <p class="text-white/70 leading-relaxed">
                Kelola lamaran, unggah dokumen, dan lihat jadwal wawancara langsung dari satu portal.
            </p>
        </div>

        <div class="relative z-10 flex items-center gap-3 text-sm text-white/70">
            <span class="material-symbols-outlined text-tertiary-fixed text-[20px]">verified_user</span>
            <span>Seluruh proses seleksi 100% bebas biaya.</span>
        </div>
    </div>

    {{-- Panel kanan (form) --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            {{-- Logo versi mobile --}}
            <a href="{{ url('/') }}" class="lg:hidden flex items-center gap-3 mb-8">
                <img src="{{ asset('images/logo-globe.png') }}" alt="Logo PT Equityworld Futures" class="h-11 w-auto">
                <span class="font-bold text-primary tracking-tight">EWF CAREER</span>
            </a>

            <h2 class="text-3xl font-bold text-primary tracking-tight">Masuk ke Akun</h2>
            <p class="mt-2 text-on-surface-variant">Silakan masukkan email dan kata sandi Anda.</p>

            @if (session('status'))
                <div class="mt-6 p-3 rounded-lg bg-surface-container text-primary text-sm">
                    {{ session('status') }}
                </div>
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
                               class="w-full h-12 pl-11 pr-3 rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
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
                               class="w-full h-12 pl-11 pr-12 rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 text-outline hover:text-primary" aria-label="Tampilkan kata sandi">
                            <span id="eye-icon" class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-on-surface-variant cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-primary">
                    Ingat saya
                </label>

                <button type="submit"
                        class="w-full h-12 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors shadow-md flex items-center justify-center gap-2">
                    <span>Masuk</span>
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
            </form>

            @if (Route::has('register'))
                <p class="mt-8 text-center text-sm text-on-surface-variant">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-secondary hover:text-primary">Daftar Akun</a>
                </p>
            @endif
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        const hidden = input.type === 'password';
        input.type = hidden ? 'text' : 'password';
        icon.textContent = hidden ? 'visibility_off' : 'visibility';
    }
</script>
</body>
</html>
