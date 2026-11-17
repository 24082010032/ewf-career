@extends('layouts.dasbor')

@section('title', 'Dasbor Pelamar')

@section('content')
@php $nama = \Illuminate\Support\Str::words(auth()->user()->name, 1, ''); @endphp

<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-primary tracking-tight">Halo, {{ $nama }}!</h1>
    <p class="text-on-surface-variant mt-1">Pantau lamaran kerja dan pendaftaran magangmu di sini.</p>
</div>

{{-- Kelengkapan profil --}}
<section class="p-6 rounded-2xl bg-primary text-white shadow-lg mb-6 relative overflow-hidden">
    <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full bg-tertiary-fixed/10 blur-3xl"></div>
    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-5">
        <div class="flex-1">
            <p class="text-sm text-primary-fixed-dim">Kelengkapan profil</p>
            <p class="text-4xl font-extrabold mt-1">{{ $persen }}%</p>
            <div class="mt-3 h-2.5 rounded-full bg-white/10 overflow-hidden max-w-md">
                <div class="h-full rounded-full bg-tertiary-fixed-dim" style="width: {{ $persen }}%"></div>
            </div>
            <p class="text-sm text-primary-fixed-dim mt-2">
                {{ $persen >= 100 ? 'Profilmu sudah lengkap.' : 'Lengkapi data diri dan pendidikan sebelum melamar.' }}
            </p>
        </div>
        <a href="{{ route('profil') }}" class="shrink-0 px-6 py-3 rounded-lg bg-tertiary-fixed text-primary font-bold hover:bg-tertiary-fixed-dim hover:text-white transition-colors text-center">
            {{ $persen >= 100 ? 'Lihat Profil' : 'Lengkapi Profil' }}
        </a>
    </div>
</section>

{{-- Ringkasan --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach ([['description', 'Lamaran Kerja', $kerja->count()], ['school', 'Pendaftaran Magang', $magang->count()], ['hourglass_top', 'Sedang Diproses', $diproses], ['verified', 'Diterima', $diterima]] as [$ik, $lb, $n])
        <div class="p-5 rounded-2xl bg-white shadow-sm border border-surface-container flex items-center gap-4">
            <span class="w-12 h-12 rounded-xl bg-surface-container grid place-items-center text-primary"><span class="material-symbols-outlined">{{ $ik }}</span></span>
            <div><div class="text-3xl font-extrabold text-primary leading-none">{{ $n }}</div><div class="text-xs text-on-surface-variant mt-1">{{ $lb }}</div></div>
        </div>
    @endforeach
</div>

{{-- Lamaran saya & Pendaftaran magang saya --}}
<div id="lamaran-saya" class="grid lg:grid-cols-2 gap-6 mb-8 scroll-mt-24">
    @foreach ([['Lamaran Kerja Saya', 'description', $kerja, route('lowongan', ['kategori' => 'karier'])], ['Pendaftaran Magang Saya', 'school', $magang, route('magang')]] as [$judul, $ik, $daftar, $cari])
        <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
            <h2 class="font-bold text-primary text-lg mb-4 flex items-center gap-2"><span class="material-symbols-outlined">{{ $ik }}</span> {{ $judul }}</h2>
            @forelse ($daftar as $l)
                <div class="flex items-start justify-between gap-3 py-3 {{ ! $loop->last ? 'border-b border-surface-container' : '' }}">
                    <div>
                        <p class="font-semibold text-primary">{{ $l->lowongan->judul ?? '-' }}</p>
                        <p class="text-xs text-on-surface-variant mt-0.5">{{ $l->no_registrasi }} &middot; {{ $l->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                    </div>
                    @include('partials.badge-status', ['status' => $l->status])
                </div>
            @empty
                <div class="py-8 text-center">
                    <span class="material-symbols-outlined text-[40px] text-outline">inbox</span>
                    <p class="text-sm text-on-surface-variant mt-1">Belum ada data.</p>
                    <a href="{{ $cari }}" class="inline-block mt-3 text-sm font-semibold text-secondary hover:text-primary">Lihat lowongan &rarr;</a>
                </div>
            @endforelse
        </section>
    @endforeach
</div>

{{-- Arti status seleksi --}}
<section id="status-seleksi" class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container scroll-mt-24">
    <h2 class="font-bold text-primary text-lg mb-4 flex items-center gap-2"><span class="material-symbols-outlined">fact_check</span> Arti Status Seleksi</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach (\App\Models\Lamaran::KETERANGAN as $kode => $arti)
            <div class="p-4 rounded-xl bg-surface-container-low">
                @include('partials.badge-status', ['status' => $kode])
                <p class="text-sm text-on-surface-variant mt-2">{{ $arti }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
