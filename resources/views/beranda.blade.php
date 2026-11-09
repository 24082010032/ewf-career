@extends('layouts.publik')

@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section class="relative bg-primary text-white overflow-hidden">
    {{-- Foto gedung sebagai latar (diredam supaya tulisan tetap terbaca) --}}
    <div class="absolute inset-y-0 right-0 w-full lg:w-3/5 bg-cover bg-center opacity-40"
         style="background-image: url('{{ asset('images/gedung-trillium.jpg') }}')"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/85 to-primary/50"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-20%,rgba(174,210,255,0.18),rgba(0,24,53,0))] pointer-events-none"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-20 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-6">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-tertiary-fixed text-xs font-semibold uppercase tracking-wide">
                <span class="w-2 h-2 rounded-full bg-tertiary-fixed animate-pulse"></span>
                Rekrutmen Resmi Talenta
            </span>
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight leading-tight">
                Temukan Peluang Karier dan Kembangkan Potensimu Bersama Kami
            </h1>
            <p class="text-lg text-primary-fixed-dim leading-relaxed max-w-2xl">
                Bergabunglah bersama PT Equityworld Futures Surabaya. Wujudkan potensi terbaikmu melalui jenjang karier profesional dan program magang bagi mahasiswa.
            </p>
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="#lowongan-terbaru" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-tertiary-fixed text-primary font-semibold shadow-md hover:bg-tertiary-fixed-dim transition-colors">
                    <span>Lihat Semua Lowongan</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
                <a href="#program-magang" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white/10 text-white font-semibold hover:bg-white/20 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">school</span>
                    <span>Program Magang Mahasiswa</span>
                </a>
            </div>
            <div class="flex flex-wrap items-center gap-6 pt-4 text-sm text-primary-fixed-dim">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary-fixed text-[20px]">verified</span>
                    <span>Seleksi 100% bebas biaya</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary-fixed text-[20px]">location_on</span>
                    <span>Kantor di Surabaya</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 flex justify-center">
            <div class="w-full max-w-md rounded-xl bg-white text-on-surface p-6 shadow-2xl">
                <div class="flex items-center justify-between pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center text-primary-fixed-dim">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary">Karier Berjangka</h4>
                            <p class="text-xs text-on-surface-variant">Ekosistem Finansial</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-surface-container text-primary text-xs font-semibold">Aktif</span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-4 rounded-lg bg-surface-container-low">
                        <span class="text-xs text-on-surface-variant">Kantor Operasional</span>
                        <div class="text-2xl font-bold text-primary mt-1">Surabaya</div>
                    </div>
                    <div class="p-4 rounded-lg bg-surface-container-low">
                        <span class="text-xs text-on-surface-variant">Peluang Posisi</span>
                        <div class="text-2xl font-bold text-primary mt-1">{{ $total }} Lowongan</div>
                    </div>
                </div>
                <div class="mt-3 p-4 rounded-lg bg-surface-container-high flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">school</span>
                        <div>
                            <div class="text-sm font-bold text-primary">Program Magang</div>
                            <div class="text-xs text-on-surface-variant">{{ $totalMagang }} program dibuka</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">check_circle</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Komitmen Kami</span>
            <h2 class="text-3xl font-bold text-primary mt-2">Mengapa Membangun Karier di EWF?</h2>
            <p class="text-on-surface-variant max-w-xl mx-auto mt-2">
                Budaya kerja profesional dengan kepatuhan regulasi industri dan pertumbuhan karier yang berkesinambungan.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['gavel', 'Kepatuhan Regulasi', 'Beroperasi sesuai regulasi perdagangan berjangka yang berlaku dengan transparansi penuh.'],
                ['stairs', 'Jenjang Karier Terbuka', 'Jalur promosi berbasis performa yang adil, dari level junior hingga manajerial.'],
                ['psychology', 'Pelatihan & Mentoring', 'Pembinaan dari praktisi pasar finansial untuk mengembangkan kompetensimu.'],
                ['groups', 'Lingkungan Kolaboratif', 'Suasana kerja inklusif dan dinamis di gedung perkantoran modern.'],
            ] as [$ikon, $judul, $isi])
                <div class="p-6 rounded-xl bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-[26px]">{{ $ikon }}</span>
                    </div>
                    <h3 class="font-bold text-primary mb-2">{{ $judul }}</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- LOWONGAN TERBARU (dari database) --}}
<section id="lowongan-terbaru" class="py-16 bg-surface-container-low scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-10">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Karier Profesional Aktif</span>
            <h2 class="text-3xl font-bold text-primary mt-1">Sorotan Lowongan Terbaru</h2>
            <p class="text-on-surface-variant mt-1">Lamar posisi yang sesuai dan bergabung bersama PT Equityworld Futures Surabaya.</p>
        </div>

        @forelse ($lowongan as $l)
            @if ($loop->first)<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">@endif

            <div class="relative overflow-hidden rounded-xl bg-white shadow-sm hover:shadow-lg transition-all p-6 flex flex-col justify-between group">
                <div class="absolute top-0 inset-x-0 h-1 {{ $l->kategori === 'magang' ? 'bg-secondary' : 'bg-tertiary-fixed-dim' }}"></div>
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-2.5 py-1 rounded bg-surface-container text-primary text-xs font-semibold">
                            {{ $l->kategori === 'magang' ? 'Program Magang' : 'Karier Profesional' }}
                        </span>
                        <span class="text-xs text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">schedule</span> {{ $l->tipe }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-primary group-hover:text-secondary transition-colors mb-3">{{ $l->judul }}</h3>
                    <div class="space-y-1.5 mb-4 text-sm text-on-surface-variant">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-secondary">pin_drop</span>
                            <span>{{ $l->cabang->nama ?? 'Surabaya' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-secondary">badge</span>
                            <span>{{ $l->min_pengalaman }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-error">event_busy</span>
                            <span>Batas Lamaran: {{ $l->batas_lamaran->locale('id')->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                    <p class="text-sm text-on-surface-variant line-clamp-2 mb-6">{{ $l->deskripsi }}</p>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <span class="text-xs text-on-surface-variant">{{ $l->departemen }}</span>
                    {{-- Halaman detail belum dibuat, nanti diarahkan ke route detail lowongan --}}
                    <a href="#" class="px-4 py-2 rounded-lg bg-primary hover:bg-secondary text-white text-xs font-semibold transition-colors flex items-center gap-1">
                        <span>Lihat Detail</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            @if ($loop->last)</div>@endif
        @empty
            <div class="p-10 rounded-xl bg-white text-center text-on-surface-variant">
                Belum ada lowongan yang dibuka saat ini. Silakan cek kembali nanti.
            </div>
        @endforelse
    </div>
</section>

{{-- PROGRAM MAGANG --}}
<section id="program-magang" class="py-16 scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-container via-primary to-primary text-white p-8 md:p-12 shadow-xl">
            <div class="absolute right-0 inset-y-0 w-1/3 bg-tertiary-fixed/5 rounded-l-full blur-2xl pointer-events-none"></div>
            <div class="relative grid lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-tertiary-fixed text-xs font-bold uppercase tracking-wide">
                        <span class="material-symbols-outlined text-[18px]">verified</span> Program Magang Mahasiswa
                    </span>
                    <h2 class="text-3xl font-bold">Persiapkan Diri Menjadi Calon Profesional Pasar Berjangka Sejak di Bangku Kuliah</h2>
                    <p class="text-primary-fixed-dim leading-relaxed">
                        Dirancang bagi mahasiswa aktif untuk mendalami dinamika industri berjangka, analisis pasar valuta asing dan komoditas, serta interaksi korporat langsung di bawah bimbingan mentor.
                    </p>
                    <div class="grid sm:grid-cols-3 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/10">
                            <span class="material-symbols-outlined text-tertiary-fixed">timelapse</span>
                            <div><p class="text-xs text-primary-fixed-dim">Durasi</p><p class="font-bold">3 - 6 Bulan</p></div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/10">
                            <span class="material-symbols-outlined text-tertiary-fixed">wallet</span>
                            <div><p class="text-xs text-primary-fixed-dim">Kompensasi</p><p class="font-bold">Uang Saku</p></div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/10">
                            <span class="material-symbols-outlined text-tertiary-fixed">badge</span>
                            <div><p class="text-xs text-primary-fixed-dim">Sertifikat</p><p class="font-bold">Resmi EWF</p></div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col gap-3 justify-center">
                    <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-lg bg-tertiary-fixed text-primary hover:bg-tertiary-fixed-dim font-bold text-center shadow-md transition-colors">Daftar Magang</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KANTOR KAMI --}}
@php $kantor = \App\Models\Cabang::first(); @endphp
<section class="py-16">
    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/lobi-ewf.jpg') }}" alt="Lobi kantor PT Equityworld Futures" class="w-full h-auto object-cover">
        </div>
        <div class="space-y-5">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Kantor Kami</span>
            <h2 class="text-3xl font-bold text-primary">Bekerja di Pusat Kota Surabaya</h2>
            <p class="text-on-surface-variant leading-relaxed">
                Kantor PT Equityworld Futures Surabaya berada di Trillium Office &amp; Residence, kawasan Jl. Pemuda. Kami menyambut talenta baru yang ingin berkembang di industri perdagangan berjangka.
            </p>
            @if ($kantor)
                <ul class="space-y-3 text-sm text-on-surface-variant">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">apartment</span>
                        <span>{{ $kantor->alamat }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">call</span>
                        <span>{{ $kantor->telepon }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">schedule</span>
                        <span>{{ $kantor->jam_operasional }}</span>
                    </li>
                </ul>
                @if ($kantor->url_peta)
                    <a href="{{ $kantor->url_peta }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">pin_drop</span>
                        <span>Lihat di Google Maps</span>
                    </a>
                @endif
            @endif
        </div>
    </div>
</section>

{{-- ALUR SELEKSI --}}
<section class="py-16 bg-surface-container-low">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Transparansi Proses</span>
            <h2 class="text-3xl font-bold text-primary mt-2">Tahapan Alur Seleksi</h2>
            <p class="text-on-surface-variant max-w-xl mx-auto mt-2">
                Setiap tahap berjalan transparan dan bisa dipantau dari akun kandidatmu.
            </p>
        </div>
        <div class="grid md:grid-cols-5 gap-4">
            @foreach ([
                ['Registrasi Akun', 'Buat akun pelamar, lengkapi profil, dan unggah CV terbaru.'],
                ['Seleksi Dokumen', 'Tim rekrutmen memverifikasi dokumen dan kualifikasi posisi.'],
                ['Asesmen Kompetensi', 'Tes online penalaran analitis dan wawasan dasar perdagangan berjangka.'],
                ['Wawancara HR & User', 'Diskusi dengan HR dan pimpinan divisi terkait kesiapan kerja.'],
                ['Penawaran & Masuk', 'Pemberian penawaran resmi disusul orientasi kerja.'],
            ] as $i => [$judul, $isi])
                <div class="p-5 rounded-xl bg-white shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-8 h-8 rounded-full {{ $i === 4 ? 'bg-tertiary-fixed text-primary' : 'bg-primary text-tertiary-fixed' }} flex items-center justify-center font-bold text-sm">{{ $i + 1 }}</span>
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
<section class="py-16">
    <div class="max-w-3xl mx-auto px-6">
        <div class="text-center mb-10">
            <span class="text-xs uppercase tracking-wider font-semibold text-secondary">Pusat Informasi</span>
            <h2 class="text-3xl font-bold text-primary mt-2">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="space-y-3">
            @foreach ([
                ['Apakah ada biaya pendaftaran atau tes dalam rekrutmen?', 'Seluruh rangkaian rekrutmen tidak dipungut biaya apa pun. Waspadai pihak yang meminta uang atas nama perusahaan.'],
                ['Dokumen apa saja yang diperlukan untuk melamar?', 'Siapkan CV terbaru, ijazah dan transkrip nilai pendidikan terakhir (format PDF, maksimal 5 MB per file), serta sertifikat pendukung jika ada.'],
                ['Bagaimana syarat Program Magang Mahasiswa?', 'Terbuka bagi mahasiswa aktif dari semua jurusan, memiliki surat pengantar dari kampus, dan bersedia mengikuti magang selama 3-6 bulan.'],
                ['Bolehkah melamar lebih dari satu posisi?', 'Boleh, namun disarankan memilih posisi yang paling sesuai dengan latar belakang dan tujuan kariermu.'],
            ] as [$tanya, $jawab])
                <details class="group rounded-xl bg-surface-container-low open:bg-surface-container transition-colors">
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

@endsection
