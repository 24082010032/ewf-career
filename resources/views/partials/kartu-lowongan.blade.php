{{-- Kartu satu lowongan. Butuh variabel $l. Tamu hanya melihat info dasar. --}}
@php
    $masukKartu = auth()->check();
    $sisaKartu  = (int) now()->startOfDay()->diffInDays($l->batas_lamaran->startOfDay(), false);
@endphp
<article class="reveal relative overflow-hidden rounded-2xl bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all p-6 flex flex-col justify-between">
    <div class="absolute top-0 inset-x-0 h-1 {{ $l->kategori === 'magang' ? 'bg-secondary' : 'bg-tertiary-fixed-dim' }}"></div>
    <div>
        <div class="flex items-center justify-between mb-3">
            <span class="px-2.5 py-1 rounded bg-surface-container text-primary text-xs font-semibold">
                {{ $l->kategori === 'magang' ? 'Program Magang' : 'Karier Profesional' }}
            </span>
            @if ($masukKartu && $sisaKartu <= 7)
                <span class="px-2 py-0.5 rounded-full bg-error-container text-error text-[11px] font-bold">Segera tutup</span>
            @else
                <span class="text-xs text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span>{{ $l->tipe }}</span>
            @endif
        </div>
        <h3 class="text-lg font-bold text-primary mb-3">{{ $l->judul }}</h3>
        <div class="space-y-1.5 mb-4 text-sm text-on-surface-variant">
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">corporate_fare</span>{{ $l->departemen }}</div>
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">pin_drop</span>{{ $l->cabang->kota ?? 'Surabaya' }}</div>
            @if ($masukKartu)
                <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-secondary">badge</span>{{ $l->min_pengalaman }}</div>
                <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-error">event_busy</span>Batas {{ $l->batas_lamaran->locale('id')->translatedFormat('d M Y') }} ({{ $sisaKartu }} hari lagi)</div>
            @endif
        </div>
        @if ($masukKartu)
            <p class="text-sm text-on-surface-variant line-clamp-2 mb-5">{{ $l->deskripsi }}</p>
        @endif
    </div>

    @if ($masukKartu)
        <button type="button" data-detail="{{ $l->id }}"
                class="w-full py-2.5 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-1.5">
            Lihat Detail <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </button>
    @else
        <a href="{{ route('login', ['terkunci' => 1]) }}"
           class="mt-2 w-full py-2.5 rounded-lg bg-surface-container text-primary text-sm font-semibold hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-1.5">
            Masuk untuk lihat detail <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    @endif
</article>
