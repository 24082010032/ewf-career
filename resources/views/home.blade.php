@extends('layouts.publik')

@section('title', 'Beranda')

@section('content')
@php
    $namaDepan = \Illuminate\Support\Str::words(auth()->user()->name, 1, '');

    $slides = [
        [
            'foto'  => 'images/gedung-trillium.jpg',
            'badge' => 'Selamat datang, ' . $namaDepan,
            'judul' => 'Temukan Peluang Karier dan Kembangkan Potensimu',
            'isi'   => 'Jelajahi lowongan terbaru di PT Equityworld Futures Surabaya dan mulai langkah karier profesionalmu.',
            'cta'   => ['Lihat Lowongan', route('lowongan')],
            'cta2'  => ['Tentang Kami', route('tentang')],
        ],
        [
            'foto'  => 'images/lobi-ewf.jpg',
            'badge' => 'Kantor Surabaya',
            'judul' => 'Bergabung dengan Tim di Pusat Kota Surabaya',
            'isi'   => 'Kantor kami berada di Trillium Office & Residence, Jl. Pemuda. Lihat alamat dan kontak lengkap.',
            'cta'   => ['Lihat Kantor', '#kantor'],
            'cta2'  => null,
        ],
        [
            'foto'  => null,
            'badge' => 'Program Magang',
            'judul' => 'Persiapkan Diri Sejak di Bangku Kuliah',
            'isi'   => 'Program magang untuk mahasiswa aktif yang ingin mendalami industri perdagangan berjangka.',
            'cta'   => ['Program Magang', route('magang')],
            'cta2'  => null,
        ],
        [
            'foto'  => null,
            'badge' => 'Seleksi Bebas Biaya',
            'judul' => 'Waspada Penipuan Atas Nama Rekrutmen',
            'isi'   => 'Seluruh proses seleksi tidak dipungut biaya apa pun. Jangan transfer uang kepada pihak mana pun.',
            'cta'   => ['Baca FAQ', '#faq'],
            'cta2'  => ['Legalitas', route('legalitas')],
        ],
    ];
@endphp

@include('partials.slider', ['slides' => $slides])

{{-- KOTAK PENCARIAN (menuju halaman Lowongan) --}}
<section class="relative z-20 -mt-10">
    <div class="max-w-6xl mx-auto px-6">
        <form method="GET" action="{{ route('lowongan') }}" class="grid md:grid-cols-12 gap-3 items-end p-5 rounded-2xl bg-white shadow-xl border border-surface-container">
            <div class="md:col-span-6">
                <label for="q" class="block text-xs font-semibold text-primary mb-1.5">Cari posisi atau kata kunci</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">search</span>
                    <input id="q" name="q" type="text" placeholder="Contoh: Financial, Konsultan, Magang..."
                           class="w-full h-12 pl-10 pr-3 rounded-lg bg-surface-container-low placeholder:text-outline focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
                </div>
            </div>
            <div class="md:col-span-4">
                <label for="kategori" class="block text-xs font-semibold text-primary mb-1.5">Kategori</label>
                <select id="kategori" name="kategori" class="w-full h-12 px-3 rounded-lg bg-surface-container-low focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary transition">
                    <option value="">Semua (Karier &amp; Magang)</option>
                    <option value="karier">Karier Profesional</option>
                    <option value="magang">Program Magang</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full h-12 rounded-lg bg-primary text-white font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">search</span> Cari
                </button>
            </div>
        </form>
    </div>
</section>

{{-- ANGKA RINGKAS --}}
<section class="pt-12">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([['work', 'Lowongan Aktif', $totalAktif], ['badge', 'Karier Profesional', $totalKarier], ['school', 'Program Magang', $totalMagang], ['location_city', 'Kantor Surabaya', 1]] as [$ikon, $label, $angka])
            <div class="reveal p-5 rounded-2xl bg-white shadow-sm flex items-center gap-4">
                <span class="w-12 h-12 rounded-xl bg-surface-container grid place-items-center text-primary"><span class="material-symbols-outlined">{{ $ikon }}</span></span>
                <div>
                    <div class="text-3xl font-extrabold text-primary leading-none" data-count="{{ $angka }}">0</div>
                    <div class="text-xs text-on-surface-variant mt-1">{{ $label }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- LOWONGAN TERBARU --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 reveal">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Karier dan Magang</span>
                <h2 class="text-3xl font-extrabold text-primary mt-1">Lowongan Terbaru</h2>
            </div>
            <a href="{{ route('lowongan') }}" class="inline-flex items-center gap-1.5 font-semibold text-secondary hover:text-primary">
                Lihat semua lowongan <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($terbaru as $l)
                @include('partials.kartu-lowongan', ['l' => $l])
            @empty
                <div class="md:col-span-3 p-10 rounded-2xl bg-white text-center text-on-surface-variant">Belum ada lowongan yang dibuka saat ini.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- PROGRAM MAGANG --}}
<section class="pb-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary-container via-primary to-primary text-white p-8 md:p-12 shadow-xl">
            <div class="absolute right-0 inset-y-0 w-1/3 bg-tertiary-fixed/10 rounded-l-full blur-2xl pointer-events-none"></div>
            <div class="relative grid lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-tertiary-fixed text-xs font-bold uppercase tracking-wide">
                        <span class="material-symbols-outlined text-[18px]">school</span> Program Magang Mahasiswa
                    </span>
                    <h2 class="text-3xl font-extrabold">Persiapkan Diri Menjadi Calon Profesional Pasar Berjangka Sejak di Bangku Kuliah</h2>
                    <p class="text-primary-fixed-dim leading-relaxed">Dirancang bagi mahasiswa aktif untuk mendalami industri berjangka di bawah bimbingan mentor.</p>
                </div>
                <div class="lg:col-span-4 flex">
                    <a href="{{ route('magang') }}" class="w-full px-6 py-3.5 rounded-lg bg-tertiary-fixed text-primary hover:bg-tertiary-fixed-dim hover:text-white font-bold text-center shadow-md transition-colors">
                        Lihat Program Magang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KANTOR KAMI --}}
<section id="kantor" class="pb-16 scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-10 items-center">
        <div class="reveal rounded-3xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/lobi-ewf.jpg') }}" alt="Lobi kantor PT Equityworld Futures" class="w-full h-auto object-cover">
        </div>
        <div class="reveal space-y-5">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Kantor Kami</span>
            <h2 class="text-3xl font-extrabold text-primary">Bekerja di Pusat Kota Surabaya</h2>
            <p class="text-on-surface-variant leading-relaxed">Kantor PT Equityworld Futures Surabaya berada di Trillium Office &amp; Residence, kawasan Jl. Pemuda.</p>
            @if ($kantor)
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
            @endif
        </div>
    </div>
</section>

{{-- ALUR SELEKSI --}}
<section class="py-16 bg-surface-container-low">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Transparansi Proses</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Tahapan Alur Seleksi</h2>
        </div>
        <div class="grid md:grid-cols-5 gap-4">
            @foreach ([
                ['Registrasi Akun', 'Buat akun pelamar, lengkapi profil, dan unggah CV terbaru.'],
                ['Seleksi Dokumen', 'Tim rekrutmen memverifikasi dokumen dan kualifikasi posisi.'],
                ['Asesmen Kompetensi', 'Tes online penalaran analitis dan wawasan dasar perdagangan berjangka.'],
                ['Wawancara HR & User', 'Diskusi dengan HR dan pimpinan divisi terkait kesiapan kerja.'],
                ['Penawaran & Masuk', 'Pemberian penawaran resmi disusul orientasi kerja.'],
            ] as $i => [$judul, $isi])
                <div class="reveal p-5 rounded-2xl bg-white shadow-sm" style="transition-delay: {{ $i * 80 }}ms">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-8 h-8 rounded-full {{ $i === 4 ? 'bg-tertiary-fixed text-primary' : 'bg-primary text-tertiary-fixed' }} grid place-items-center font-bold text-sm">{{ $i + 1 }}</span>
                        <span class="text-xs text-secondary font-semibold uppercase">Langkah 0{{ $i + 1 }}</span>
                    </div>
                    <h4 class="font-bold text-primary mb-1">{{ $judul }}</h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="py-16 scroll-mt-20">
    <div class="max-w-3xl mx-auto px-6">
        <div class="text-center mb-10 reveal">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Pusat Informasi</span>
            <h2 class="text-3xl font-extrabold text-primary mt-2">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="space-y-3">
            @foreach ([
                ['Apakah ada biaya pendaftaran atau tes dalam rekrutmen?', 'Seluruh rangkaian rekrutmen tidak dipungut biaya apa pun. Waspadai pihak yang meminta uang atas nama perusahaan.'],
                ['Dokumen apa saja yang diperlukan untuk melamar?', 'Siapkan CV terbaru, ijazah dan transkrip nilai pendidikan terakhir (format PDF, maksimal 5 MB per file), serta sertifikat pendukung jika ada.'],
                ['Bagaimana syarat Program Magang Mahasiswa?', 'Terbuka bagi mahasiswa aktif dari semua jurusan, memiliki surat pengantar dari kampus, dan bersedia mengikuti magang selama 3-6 bulan.'],
                ['Bolehkah melamar lebih dari satu posisi?', 'Boleh, namun disarankan memilih posisi yang paling sesuai dengan latar belakang dan tujuan kariermu.'],
            ] as [$tanya, $jawab])
                <details class="reveal group rounded-2xl bg-white open:bg-surface-container-low shadow-sm transition-colors">
                    <summary class="p-5 flex items-center justify-between gap-4 cursor-pointer font-semibold text-primary">
                        <span>{{ $tanya }}</span>
                        <span class="material-symbols-outlined faq-icon text-on-surface-variant transition-transform">expand_more</span>
                    </summary>
                    <div class="px-5 pb-5 text-sm text-on-surface-variant leading-relaxed">{{ $jawab }}</div>
                </details>
            @endforeach
        </div>
    </div>
</section>

@include('partials.modal-lowongan')
@endsection

@push('scripts')
<script>
    // Angka naik saat terlihat
    (function () {
        var els = document.querySelectorAll('[data-count]');
        function jalan(el) {
            var target = parseInt(el.getAttribute('data-count'), 10) || 0, t0 = null;
            function step(t) {
                if (!t0) t0 = t;
                var p = Math.min((t - t0) / 900, 1);
                el.textContent = Math.round(target * p);
                if (p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }
        if (!('IntersectionObserver' in window)) { els.forEach(jalan); return; }
        var io = new IntersectionObserver(function (items) {
            items.forEach(function (it) { if (it.isIntersecting) { jalan(it.target); io.unobserve(it.target); } });
        }, { threshold: 0.4 });
        els.forEach(function (e) { io.observe(e); });
    })();
</script>
@endpush
