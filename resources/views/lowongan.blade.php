@extends('layouts.publik')

@section('title', $mode === 'magang' ? 'Program Magang' : 'Lowongan Kerja')

@section('content')
@php
    $aksi  = $mode === 'magang' ? route('magang') : route('lowongan');
    $judul = $mode === 'magang' ? 'Program Magang Mahasiswa' : 'Lowongan Kerja';
@endphp

{{-- Judul halaman --}}
<section class="relative bg-primary text-white overflow-hidden">
    <div class="absolute inset-y-0 right-0 w-full lg:w-1/2 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/gedung-trillium.jpg') }}')"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/90 to-primary/40"></div>
    <div class="relative max-w-6xl mx-auto px-6 py-14">
        <p class="text-sm text-primary-fixed-dim"><a href="{{ auth()->check() ? route('home') : route('beranda') }}" class="hover:text-white">Beranda</a> / {{ $judul }}</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-3">{{ $judul }}</h1>
        <p class="text-lg text-primary-fixed-dim mt-3 max-w-2xl">
            @if ($mode === 'magang')
                Dapatkan pengalaman langsung di industri perdagangan berjangka sejak di bangku kuliah.
            @else
                Pilih posisi karier maupun magang yang sesuai dengan latar belakang dan tujuanmu.
            @endif
        </p>
    </div>
</section>

@if ($mode === 'magang')
<section class="pt-12">
    <div class="max-w-6xl mx-auto px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([['timelapse', 'Durasi', '3 - 6 Bulan'], ['wallet', 'Kompensasi', 'Uang Saku'], ['badge', 'Sertifikat', 'Resmi EWF'], ['school', 'Syarat', 'Mahasiswa aktif + surat pengantar kampus']] as [$ik, $lb, $vl])
            <div class="reveal p-5 rounded-2xl bg-white shadow-sm flex items-center gap-4">
                <span class="w-12 h-12 shrink-0 rounded-xl bg-surface-container grid place-items-center text-primary"><span class="material-symbols-outlined">{{ $ik }}</span></span>
                <div><p class="text-xs text-on-surface-variant">{{ $lb }}</p><p class="font-bold text-primary text-sm">{{ $vl }}</p></div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- Pencarian --}}
<section class="pt-10">
    <div class="max-w-6xl mx-auto px-6">
        <form method="GET" action="{{ $aksi }}" class="grid md:grid-cols-12 gap-3 items-end p-5 rounded-2xl bg-white shadow-lg border border-surface-container">
            <div class="{{ $mode === 'magang' ? 'md:col-span-10' : 'md:col-span-6' }}">
                <label for="q" class="block text-xs font-semibold text-primary mb-1.5">Cari posisi atau kata kunci</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">search</span>
                    <input id="q" name="q" value="{{ $q }}" type="text" placeholder="Contoh: Financial, Konsultan, Riset..."
                           class="w-full h-12 pl-10 pr-3 rounded-lg bg-surface-container-low placeholder:text-outline focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
                </div>
            </div>
            @if ($mode !== 'magang')
                <div class="md:col-span-4">
                    <label for="kategori" class="block text-xs font-semibold text-primary mb-1.5">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full h-12 px-3 rounded-lg bg-surface-container-low focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
                        <option value="">Semua (Karier &amp; Magang)</option>
                        <option value="karier" @selected($kategori === 'karier')>Karier Profesional</option>
                        <option value="magang" @selected($kategori === 'magang')>Program Magang</option>
                    </select>
                </div>
            @endif
            <div class="md:col-span-2">
                <button type="submit" class="w-full h-12 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">search</span> Cari
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Daftar --}}
<section class="py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-primary">
                {{ $lowongan->count() }} {{ $mode === 'magang' ? 'program magang' : 'lowongan' }} ditemukan
            </h2>
            @if ($q !== '' || ($mode !== 'magang' && $kategori))
                <p class="text-sm text-on-surface-variant mt-1">
                    @if ($q !== '') Kata kunci: "<strong>{{ $q }}</strong>". @endif
                    <a href="{{ $aksi }}" class="font-semibold text-secondary hover:text-primary">Hapus filter</a>
                </p>
            @endif
        </div>

        @guest
            <div class="mb-8 p-4 rounded-2xl bg-surface-container flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-sm">
                <span class="text-primary">Kamu melihat informasi dasar. Masuk untuk membuka detail lengkap dan melamar.</span>
                <span class="flex gap-2 shrink-0">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-white font-semibold text-primary hover:bg-primary hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors">Daftar Akun</a>
                </span>
            </div>
        @endguest

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lowongan as $l)
                @include('partials.kartu-lowongan', ['l' => $l])
            @empty
                <div class="md:col-span-2 lg:col-span-3 p-12 rounded-2xl bg-white text-center">
                    <span class="material-symbols-outlined text-[48px] text-outline">search_off</span>
                    <p class="font-semibold text-primary mt-2">Tidak ada yang cocok</p>
                    <p class="text-sm text-on-surface-variant mt-1">Coba kata kunci lain atau <a href="{{ $aksi }}" class="font-semibold text-secondary hover:text-primary">hapus filter</a>.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@auth
    @include('partials.modal-lowongan')
@endauth
@endsection
