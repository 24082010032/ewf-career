@php
    $warnaStatus = [
        'menunggu'           => 'bg-surface-container text-primary',
        'ditinjau'           => 'bg-sky-100 text-sky-800',
        'lolos_administrasi' => 'bg-emerald-100 text-emerald-800',
        'tidak_lolos'        => 'bg-red-100 text-red-700',
        'tahap_seleksi'      => 'bg-violet-100 text-violet-800',
        'diterima'           => 'bg-emerald-600 text-white',
    ];
@endphp
<span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $warnaStatus[$status] ?? 'bg-surface-container text-primary' }}">
    {{ \App\Models\Lamaran::STATUS[$status] ?? $status }}
</span>
