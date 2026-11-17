@extends('layouts.dasbor')

@section('title', 'Dasbor HRD')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-primary tracking-tight">Dasbor HRD</h1>
    <p class="text-on-surface-variant mt-1">Ringkasan rekrutmen: lamaran kerja dan pendaftaran magang.</p>
</div>

<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach ([['groups', 'Total Pendaftar', $total], ['work', 'Lamaran Kerja', $kerja], ['school', 'Pendaftar Magang', $magang], ['pending_actions', 'Perlu Ditinjau', $perlu], ['campaign', 'Lowongan Aktif', $lowongan->count()]] as [$ik, $lb, $n])
        <div class="p-5 rounded-2xl bg-white shadow-sm border border-surface-container">
            <span class="w-10 h-10 rounded-xl bg-surface-container grid place-items-center text-primary mb-3"><span class="material-symbols-outlined">{{ $ik }}</span></span>
            <div class="text-3xl font-extrabold text-primary leading-none">{{ $n }}</div>
            <div class="text-xs text-on-surface-variant mt-1">{{ $lb }}</div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-8">
    {{-- Sebaran status --}}
    <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
        <h2 class="font-bold text-primary text-lg mb-4">Sebaran Status</h2>
        <div class="space-y-3">
            @foreach (\App\Models\Lamaran::STATUS as $kode => $label)
                @php $jml = $perStatus[$kode] ?? 0; $persen = $total > 0 ? round($jml / $total * 100) : 0; @endphp
                <div>
                    <div class="flex justify-between text-sm mb-1"><span class="text-on-surface-variant">{{ $label }}</span><span class="font-semibold text-primary">{{ $jml }}</span></div>
                    <div class="h-2 rounded-full bg-surface-container overflow-hidden"><div class="h-full rounded-full bg-primary" style="width: {{ $persen }}%"></div></div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pendaftar terbaru --}}
    <section class="lg:col-span-2 p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-primary text-lg">Pendaftar Terbaru</h2>
            <span class="text-xs px-2 py-1 rounded bg-surface-container text-on-surface-variant">Lamaran kerja &amp; magang</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs uppercase text-on-surface-variant bg-surface-container-low">
                        <th class="py-2.5 px-3 rounded-l-lg">Pelamar</th><th class="py-2.5 px-3">Posisi</th><th class="py-2.5 px-3">Jenis</th><th class="py-2.5 px-3 rounded-r-lg">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($terbaru as $l)
                        <tr class="border-b border-surface-container last:border-0">
                            <td class="py-3 px-3">
                                <p class="font-semibold text-primary">{{ $l->user->name ?? '-' }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $l->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                            </td>
                            <td class="py-3 px-3 text-on-surface">{{ $l->lowongan->judul ?? '-' }}</td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 rounded bg-surface-container text-xs font-semibold text-primary">{{ ($l->lowongan->kategori ?? '') === 'magang' ? 'Magang' : 'Kerja' }}</span>
                            </td>
                            <td class="py-3 px-3">@include('partials.badge-status', ['status' => $l->status])</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-10 text-center text-on-surface-variant">Belum ada pendaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="text-xs text-on-surface-variant mt-4">Ubah status, periksa dokumen, dan kelola lowongan akan ditambahkan di tahap berikutnya.</p>
    </section>
</div>

{{-- Lowongan aktif --}}
<section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
    <h2 class="font-bold text-primary text-lg mb-4">Lowongan dan Program Magang Aktif</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($lowongan as $l)
            <div class="p-4 rounded-xl bg-surface-container-low flex items-start justify-between gap-3">
                <div>
                    <p class="font-semibold text-primary">{{ $l->judul }}</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ $l->kategori === 'magang' ? 'Program Magang' : 'Karier' }} &middot; sampai {{ $l->batas_lamaran->locale('id')->translatedFormat('d M Y') }}</p>
                </div>
                <span class="shrink-0 text-center"><span class="block text-xl font-extrabold text-primary leading-none">{{ $l->lamaran_count }}</span><span class="text-[10px] text-on-surface-variant">pendaftar</span></span>
            </div>
        @empty
            <p class="text-on-surface-variant">Belum ada lowongan aktif.</p>
        @endforelse
    </div>
</section>
@endsection
