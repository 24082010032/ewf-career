{{-- LEGALITAS & PENGAWASAN --}}
@php
    // Hanya lembaga yang sudah terverifikasi. Untuk menambah lembaga lain, salin satu blok [ ... ] lalu isi datanya.
    // 'logo'  : taruh file logo di public/images/legalitas/ (kalau file tidak ada, otomatis tampil nama teks)
    // 'url'   : alamat situs resmi. Kalau diisi null, kartu tampil tanpa link.
    $nomorIzin = '850/BAPPEBTI/SI/12/2005';

    $lembaga = [
        [
            'nama'    => 'Bappebti',
            'lengkap' => 'Badan Pengawas Perdagangan Berjangka Komoditi, Kementerian Perdagangan RI',
            'peran'   => 'Pengawas dan pemberi izin usaha pialang berjangka',
            'url'     => 'https://www.bappebti.go.id',
            'logo'    => 'images/legalitas/bappebti.png',
        ],
        [
            'nama'    => 'JFX',
            'lengkap' => 'PT Bursa Berjangka Jakarta (Jakarta Futures Exchange)',
            'peran'   => 'Bursa berjangka tempat EWF terdaftar sebagai anggota',
            'url'     => 'https://www.jfx.co.id',
            'logo'    => 'images/legalitas/jfx.png',
        ],
        [
            'nama'    => 'KBI',
            'lengkap' => 'PT Kliring Berjangka Indonesia (Persero)',
            'peran'   => 'Lembaga kliring dan penjaminan transaksi perdagangan berjangka',
            'url'     => null, // ISI dengan alamat situs resmi KBI setelah kamu pastikan sendiri
            'logo'    => 'images/legalitas/kbi.png',
        ],
    ];
@endphp

<section id="legalitas" class="py-16 bg-surface-container-low scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-10">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Kepercayaan & Kepatuhan</span>
            <h2 class="text-3xl font-bold text-primary mt-2">Legalitas dan Pengawasan</h2>
            <p class="text-on-surface-variant max-w-2xl mx-auto mt-2">
                PT Equityworld Futures adalah perusahaan pialang berjangka yang berizin dan terdaftar pada lembaga resmi berikut. Kamu bisa memeriksanya langsung di situs masing-masing.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($lembaga as $l)
                @php $ada = !empty($l['url']); @endphp
                <{{ $ada ? 'a' : 'div' }}
                    @if ($ada) href="{{ $l['url'] }}" target="_blank" rel="noopener noreferrer" @endif
                    class="group flex flex-col rounded-xl bg-white p-6 shadow-sm {{ $ada ? 'hover:shadow-lg hover:-translate-y-0.5 transition-all' : '' }}">
                    <div class="h-16 flex items-center justify-center mb-4">
                        @if (file_exists(public_path($l['logo'])))
                            <img src="{{ asset($l['logo']) }}" alt="Logo {{ $l['nama'] }}" class="max-h-14 w-auto">
                        @else
                            <span class="text-3xl font-bold tracking-tight text-primary">{{ $l['nama'] }}</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-primary text-center">{{ $l['lengkap'] }}</h3>
                    <p class="text-sm text-on-surface-variant text-center mt-2 flex-1">{{ $l['peran'] }}</p>
                    @if ($ada)
                        <span class="mt-4 inline-flex items-center justify-center gap-1 text-sm font-semibold text-secondary group-hover:text-primary">
                            Kunjungi situs resmi
                            <span class="material-symbols-outlined text-[18px]">arrow_outward</span>
                        </span>
                    @endif
                </{{ $ada ? 'a' : 'div' }}>
            @endforeach
        </div>

        <div class="mt-8 max-w-2xl mx-auto rounded-xl bg-white p-5 flex items-start gap-4 shadow-sm">
            <span class="material-symbols-outlined text-secondary text-[28px]">verified</span>
            <div class="text-sm text-on-surface-variant leading-relaxed">
                <p class="font-semibold text-primary">Izin Usaha Pialang Berjangka</p>
                <p>Nomor izin: <span class="font-semibold text-on-surface">{{ $nomorIzin }}</span></p>
                <p class="mt-2">Seluruh proses rekrutmen tidak dipungut biaya. Jika ada pihak yang meminta uang atas nama perusahaan, abaikan dan laporkan.</p>
            </div>
        </div>
    </div>
</section>

