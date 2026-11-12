@extends('layouts.publik')

@section('title', 'Tentang Kami')

@section('content')
{{-- Judul halaman --}}
<section class="relative bg-primary text-white overflow-hidden">
    <div class="absolute inset-y-0 right-0 w-full lg:w-1/2 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/lobi-ewf.jpg') }}')"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/90 to-primary/40"></div>
    <div class="relative max-w-6xl mx-auto px-6 py-16">
        <p class="text-sm text-primary-fixed-dim"><a href="{{ auth()->check() ? route('home') : route('beranda') }}" class="hover:text-white">Beranda</a> / Tentang Kami</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-3">Tentang PT Equityworld Futures</h1>
        <p class="text-lg text-primary-fixed-dim mt-3 max-w-2xl">Mengenal perusahaan pialang berjangka tempat kamu bisa membangun karier.</p>
    </div>
</section>

{{-- Profil --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-12 gap-10">
        <div class="lg:col-span-7 space-y-5 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Profil Perusahaan</span>
            <h2 class="text-3xl font-extrabold text-primary">Perusahaan Pialang Berjangka di Indonesia</h2>
            <p class="text-on-surface-variant leading-relaxed">
                PT Equityworld Futures (EWF) adalah perusahaan pialang berjangka yang bergerak di bidang perdagangan berjangka komoditi dan derivatif. Perusahaan ini berdiri sejak tahun 2005 dan berperan sebagai perantara yang menghubungkan nasabah dengan bursa berjangka.
            </p>
            <p class="text-on-surface-variant leading-relaxed">
                EWF terdaftar sebagai anggota Bursa Berjangka Jakarta (JFX) dan Kliring Berjangka Indonesia (KBI), serta memiliki izin usaha pialang berjangka dari Badan Pengawas Perdagangan Berjangka Komoditi (Bappebti) di bawah Kementerian Perdagangan Republik Indonesia.
            </p>
            <p class="text-on-surface-variant leading-relaxed">
                Kegiatan usahanya dijalankan secara daring melalui sistem perdagangan yang terintegrasi, dengan penekanan pada pelayanan dan edukasi kepada nasabah mengenai peluang sekaligus risiko dalam perdagangan berjangka. Perusahaan juga memiliki kantor cabang di sejumlah kota, di antaranya Jakarta, Surabaya, Semarang, dan Manado.
            </p>
        </div>

        <aside class="lg:col-span-5 reveal">
            <div class="rounded-3xl bg-white shadow-lg border border-surface-container p-6">
                <div class="flex items-center gap-3 pb-4 border-b border-surface-container">
                    <img src="{{ asset('images/logo-ewf.png') }}" alt="" class="h-14 w-auto">
                    <div>
                        <p class="font-bold text-primary">PT Equityworld Futures</p>
                        <p class="text-xs text-on-surface-variant">Pialang Berjangka</p>
                    </div>
                </div>
                <dl class="mt-4 space-y-3 text-sm">
                    @foreach ([
                        ['Berdiri', '2005'],
                        ['Bidang usaha', 'Perdagangan berjangka komoditi dan derivatif'],
                        ['Keanggotaan', 'JFX dan KBI'],
                        ['Pengawas', 'Bappebti, Kementerian Perdagangan RI'],
                        ['Kantor Surabaya', 'Trillium Office & Residence, Jl. Pemuda'],
                        ['Lowongan aktif', $total . ' posisi'],
                    ] as [$k, $v])
                        <div class="flex justify-between gap-4">
                            <dt class="text-on-surface-variant">{{ $k }}</dt>
                            <dd class="font-semibold text-primary text-right">{{ $v }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </aside>
    </div>
</section>

{{-- Layanan --}}
<section class="py-16 bg-surface-container-low">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Layanan</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Apa yang Dilakukan Perusahaan</h2>
            <p class="text-on-surface-variant max-w-2xl mx-auto mt-2">Layanan utama yang tersedia bagi nasabah di kantor cabang Surabaya.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['person_add', 'Pembukaan Rekening', 'Pendaftaran nasabah dan pengisian profil serta dokumen yang diperlukan.'],
                ['school', 'Edukasi Awal', 'Penjelasan dasar perdagangan berjangka, termasuk margin dan risikonya.'],
                ['devices', 'Aplikasi Perdagangan', 'Penyediaan aplikasi untuk bertransaksi secara daring.'],
                ['support_agent', 'Eksekusi Order & Layanan Teknis', 'Pelaksanaan order dan bantuan teknis terkait transaksi.'],
            ] as $i => [$ikon, $judul, $isi])
                <div class="reveal p-6 rounded-2xl bg-white shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all" style="transition-delay: {{ $i * 80 }}ms">
                    <div class="w-12 h-12 rounded-xl bg-surface-container grid place-items-center text-primary mb-4"><span class="material-symbols-outlined text-[26px]">{{ $ikon }}</span></div>
                    <h3 class="font-bold text-primary mb-2">{{ $judul }}</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Produk --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Produk</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Produk Perdagangan Berjangka</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ([
                ['monetization_on', 'Kontrak Berjangka Komoditas', 'Termasuk kontrak emas yang diperdagangkan dengan sistem margin.'],
                ['show_chart', 'Indeks Saham', 'Kontrak berjangka yang mengacu pada indeks pasar saham.'],
                ['currency_exchange', 'Mata Uang', 'Kontrak berjangka berbasis pasangan mata uang.'],
            ] as $i => [$ikon, $judul, $isi])
                <div class="reveal flex items-start gap-4 p-6 rounded-2xl bg-white shadow-sm border border-surface-container" style="transition-delay: {{ $i * 80 }}ms">
                    <span class="w-12 h-12 shrink-0 rounded-xl bg-primary text-tertiary-fixed grid place-items-center"><span class="material-symbols-outlined">{{ $ikon }}</span></span>
                    <div>
                        <h3 class="font-bold text-primary">{{ $judul }}</h3>
                        <p class="text-sm text-on-surface-variant mt-1 leading-relaxed">{{ $isi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="reveal mt-8 p-5 rounded-2xl bg-error-container/50 flex items-start gap-3 text-sm text-on-surface">
            <span class="material-symbols-outlined text-error">warning</span>
            <p>Perdagangan berjangka menggunakan margin dan memiliki risiko kerugian. Informasi pada halaman ini bersifat umum dan bukan ajakan untuk berinvestasi.</p>
        </div>
    </div>
</section>

{{-- Legalitas ringkas --}}
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal rounded-3xl bg-primary text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-xl">
            <div class="flex items-start gap-4">
                <span class="w-12 h-12 shrink-0 rounded-xl bg-white/10 grid place-items-center text-tertiary-fixed"><span class="material-symbols-outlined">verified_user</span></span>
                <div>
                    <h2 class="text-2xl font-extrabold">Berizin dan Diawasi</h2>
                    <p class="text-primary-fixed-dim mt-1">Lihat lembaga pengawas dan nomor izin usaha perusahaan, lengkap dengan tautan situs resminya.</p>
                </div>
            </div>
            <a href="{{ route('legalitas') }}" class="shrink-0 px-6 py-3 rounded-lg bg-tertiary-fixed text-primary font-bold hover:bg-tertiary-fixed-dim hover:text-white transition-colors text-center">Lihat Legalitas</a>
        </div>
    </div>
</section>

{{-- Kantor Surabaya --}}
@if ($kantor)
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-10 items-center">
        <div class="reveal rounded-3xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/gedung-trillium.jpg') }}" alt="Gedung kantor Surabaya" class="w-full h-72 object-cover">
        </div>
        <div class="reveal space-y-4">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Kantor Surabaya</span>
            <h2 class="text-3xl font-extrabold text-primary">Kunjungi Kami</h2>
            <ul class="space-y-3 text-sm text-on-surface-variant">
                <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary text-[20px]">apartment</span><span>{{ $kantor->alamat }}</span></li>
                <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary text-[20px]">call</span><span>{{ $kantor->telepon }}</span></li>
                <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary text-[20px]">schedule</span><span>{{ $kantor->jam_operasional }}</span></li>
            </ul>
            @if ($kantor->url_peta)
                <a href="{{ $kantor->url_peta }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-[18px]">pin_drop</span> Lihat di Google Maps
                </a>
            @endif
        </div>
    </div>
</section>
@endif

{{-- Sumber --}}
<section class="pb-8">
    <div class="max-w-4xl mx-auto px-6">
        <div class="reveal p-6 rounded-2xl bg-surface-container-low text-sm text-on-surface-variant">
            <p class="font-semibold text-primary mb-2">Sumber informasi</p>
            <p class="mb-3">Informasi disusun dari sumber publik. Untuk data resmi dan terbaru, silakan konfirmasi langsung ke perusahaan.</p>
            <ul class="space-y-1.5 list-disc pl-5">
                <li><a class="text-secondary hover:text-primary underline" target="_blank" rel="noopener" href="https://repository.um-surabaya.ac.id/id/eprint/11298/4/Bab%203_Ifatul%20Muzarkosah_20232554040.pdf">Repositori Universitas Muhammadiyah Surabaya: profil EWF Cabang Surabaya</a></li>
                <li><a class="text-secondary hover:text-primary underline" target="_blank" rel="noopener" href="https://eprints.upj.ac.id/id/eprint/13779/9/BAB%20II_RICKO%20ARIANSYAH_LKP.pdf">Repositori UPJ: gambaran umum PT Equityworld Futures</a></li>
                <li><a class="text-secondary hover:text-primary underline" target="_blank" rel="noopener" href="https://conference.untag-sby.ac.id/index.php/bis/article/view/4443/2665">Prosiding UNTAG Surabaya: EquityWorld Futures Trillium Surabaya</a></li>
                <li><a class="text-secondary hover:text-primary underline" target="_blank" rel="noopener" href="https://finance.detik.com/bursa-dan-valas/d-7504663/daftar-pialang-berjangka-resmi-bappebti-jangan-gabung-investasi-bodong">detikFinance: daftar pialang berjangka resmi Bappebti</a></li>
            </ul>
        </div>
    </div>
</section>
@endsection
