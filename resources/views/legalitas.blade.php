@extends('layouts.publik')

@section('title', 'Legalitas')

@section('content')
<section class="relative bg-primary text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-container via-primary to-primary"></div>
    <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-tertiary-fixed/10 blur-3xl"></div>
    <div class="relative max-w-6xl mx-auto px-6 py-16">
        <p class="text-sm text-primary-fixed-dim"><a href="{{ auth()->check() ? route('home') : route('beranda') }}" class="hover:text-white">Beranda</a> / Legalitas</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-3">Legalitas Perusahaan</h1>
        <p class="text-lg text-primary-fixed-dim mt-3 max-w-2xl">Kenali lembaga yang mengawasi perusahaan dan cara memeriksanya sendiri.</p>
    </div>
</section>

@include('partials.legalitas')

<section class="py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-10 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Verifikasi Mandiri</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Cara Memeriksa Legalitas</h2>
        </div>
        <ol class="space-y-4">
            @foreach ([
                'Buka situs resmi Bappebti lewat kartu di atas.',
                'Cari daftar perusahaan pialang berjangka yang berizin.',
                'Cocokkan nama perusahaan dan nomor izin usaha dengan yang tertera di halaman ini.',
                'Jika ada keraguan, hubungi kantor perusahaan lewat nomor telepon resmi di halaman Tentang Kami.',
            ] as $i => $langkah)
                <li class="reveal flex items-start gap-4 p-5 rounded-2xl bg-white shadow-sm">
                    <span class="w-9 h-9 shrink-0 rounded-full bg-primary text-tertiary-fixed grid place-items-center font-bold">{{ $i + 1 }}</span>
                    <p class="text-on-surface-variant leading-relaxed pt-1">{{ $langkah }}</p>
                </li>
            @endforeach
        </ol>

        <div class="reveal mt-8 p-5 rounded-2xl bg-error-container/50 flex items-start gap-3 text-sm text-on-surface">
            <span class="material-symbols-outlined text-error">gpp_maybe</span>
            <p><strong>Waspada penipuan.</strong> Seluruh proses rekrutmen tidak dipungut biaya. Jangan transfer uang kepada pihak mana pun yang mengaku mewakili perusahaan.</p>
        </div>
    </div>
</section>
@endsection
