@extends('layouts.publik')

@section('title', 'Beranda')

@section('content')
@php
    $slides = [
        [
            'foto'  => 'images/gedung-trillium.jpg',
            'badge' => 'Rekrutmen Resmi Talenta',
            'judul' => 'Mulai Kariermu di Industri Perdagangan Berjangka',
            'isi'   => 'PT Equityworld Futures Surabaya membuka kesempatan bagi talenta muda dan profesional.',
            'cta'   => ['Lihat Lowongan', route('lowongan')],
            'cta2'  => ['Tentang Kami', route('tentang')],
        ],
        [
            'foto'  => 'images/lobi-ewf.jpg',
            'badge' => 'Kenali Perusahaan',
            'judul' => 'PT Equityworld Futures, Pialang Berjangka di Surabaya',
            'isi'   => 'Pelajari profil, layanan, dan kantor kami sebelum kamu melamar.',
            'cta'   => ['Tentang Kami', route('tentang')],
            'cta2'  => ['Legalitas', route('legalitas')],
        ],
        [
            'foto'  => null,
            'badge' => 'Program Magang',
            'judul' => 'Magang untuk Mahasiswa yang Ingin Berkembang',
            'isi'   => 'Dapatkan pengalaman langsung di industri perdagangan berjangka bersama mentor berpengalaman.',
            'cta'   => ['Program Magang', route('magang')],
            'cta2'  => ['Daftar Akun', route('register')],
        ],
        [
            'foto'  => null,
            'badge' => 'Seleksi Bebas Biaya',
            'judul' => 'Seluruh Proses Seleksi Tanpa Biaya',
            'isi'   => 'Waspada penipuan. Perusahaan tidak pernah meminta uang dalam proses rekrutmen.',
            'cta'   => ['Buat Akun', route('register')],
            'cta2'  => ['Masuk', route('login')],
        ],
    ];
@endphp

@include('partials.slider', ['slides' => $slides])

{{-- TEKS BERJALAN --}}
<div class="marquee overflow-hidden bg-white border-b border-surface-container">
    <div class="marquee-track py-3 text-sm font-semibold text-on-surface-variant">
        @for ($k = 0; $k < 2; $k++)
            <div class="flex items-center shrink-0">
                @foreach (['Seleksi 100% bebas biaya', 'Kantor di Surabaya', 'Program magang mahasiswa', 'Jenjang karier terbuka', 'Pelatihan dan mentoring', 'Anggota bursa berjangka dan lembaga kliring'] as $t)
                    <span class="px-8 flex items-center gap-8"><span>{{ $t }}</span><span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed-dim"></span></span>
                @endforeach
            </div>
        @endfor
    </div>
</div>

{{-- ANGKA RINGKAS --}}
<section class="py-12">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach ([['work', 'Lowongan Aktif', $total], ['school', 'Program Magang', $totalMagang], ['location_city', 'Kantor di Surabaya', 1]] as [$ikon, $label, $angka])
            <div class="reveal p-5 rounded-2xl bg-white shadow-sm flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-surface-container grid place-items-center text-primary"><span class="material-symbols-outlined">{{ $ikon }}</span></span>
                <div>
                    <div class="text-3xl font-extrabold text-primary leading-none">{{ $angka }}</div>
                    <div class="text-xs text-on-surface-variant mt-1">{{ $label }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- TENTANG SINGKAT --}}
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Tentang Kami</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Mengapa Membangun Karier di EWF?</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['gavel', 'Kepatuhan Regulasi', 'Beroperasi sesuai regulasi perdagangan berjangka yang berlaku.'],
                ['stairs', 'Jenjang Karier Terbuka', 'Jalur promosi berbasis performa dari level junior hingga manajerial.'],
                ['psychology', 'Pelatihan & Mentoring', 'Pembinaan dari praktisi untuk mengembangkan kompetensimu.'],
                ['groups', 'Lingkungan Kolaboratif', 'Suasana kerja dinamis di gedung perkantoran modern.'],
            ] as $i => [$ikon, $judul, $isi])
                <div class="reveal p-6 rounded-2xl bg-white shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all" style="transition-delay: {{ $i * 80 }}ms">
                    <div class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-[26px]">{{ $ikon }}</span>
                    </div>
                    <h3 class="font-bold text-primary mb-2">{{ $judul }}</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8 reveal">
            <a href="{{ route('tentang') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white border border-surface-container text-primary font-semibold hover:bg-primary hover:text-white transition-colors">
                Selengkapnya tentang PT Equityworld Futures <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
</section>

{{-- CUPLIKAN LOWONGAN --}}
<section class="py-16 bg-surface-container-low">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 reveal">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Cuplikan Lowongan</span>
                <h2 class="text-3xl font-extrabold text-primary mt-1">Posisi yang Sedang Dibuka</h2>
                <p class="text-on-surface-variant mt-1">Masuk untuk melihat detail lengkap dan melamar.</p>
            </div>
            <a href="{{ route('lowongan') }}" class="inline-flex items-center gap-1.5 font-semibold text-secondary hover:text-primary">
                Lihat semua lowongan <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($cuplikan as $l)
                @include('partials.kartu-lowongan', ['l' => $l])
            @empty
                <div class="md:col-span-3 p-10 rounded-2xl bg-white text-center text-on-surface-variant">Belum ada lowongan yang dibuka saat ini.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- AJAKAN DAFTAR --}}
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6 reveal">
        <div class="rounded-3xl bg-primary text-white p-8 md:p-12 text-center shadow-xl relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-tertiary-fixed/10 blur-3xl"></div>
            <h2 class="relative text-3xl font-extrabold">Siap Memulai Langkah Kariermu?</h2>
            <p class="relative text-primary-fixed-dim mt-3 max-w-xl mx-auto">Buat akun gratis untuk melihat detail lowongan, melamar posisi, dan memantau proses seleksimu.</p>
            <div class="relative flex flex-wrap justify-center gap-3 mt-6">
                <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-lg bg-tertiary-fixed text-primary font-bold hover:bg-tertiary-fixed-dim hover:text-white transition-colors">Daftar Akun</a>
                <a href="{{ route('login') }}" class="px-8 py-3.5 rounded-lg bg-white/10 font-semibold hover:bg-white/20 transition-colors">Masuk</a>
            </div>
        </div>
    </div>
</section>
@endsection
