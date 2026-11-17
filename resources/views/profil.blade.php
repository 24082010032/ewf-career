@extends('layouts.dasbor')

@section('title', 'Profil Saya')

@section('content')
@php
    // Nilai awal tiap kolom: isian lama (jika validasi gagal) atau data tersimpan
    $val = fn ($k) => old($k, $profil?->{$k});
    $tgl = old('tanggal_lahir', $profil?->tanggal_lahir?->format('Y-m-d'));
    $kelas = 'w-full h-11 px-3 rounded-lg bg-white border border-surface-container text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary transition';
@endphp

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-primary tracking-tight">Profil Saya</h1>
        <p class="text-on-surface-variant mt-1">Lihat dan ubah data dirimu.</p>
    </div>
    <span class="self-start px-3 py-1.5 rounded-full bg-surface-container text-primary text-sm font-semibold">{{ $user->roleLabel() }}</span>
</div>

@if (session('status') === 'profil-tersimpan')
    <div class="mb-6 p-4 rounded-xl bg-emerald-50 text-emerald-800 text-sm flex items-center gap-2">
        <span class="material-symbols-outlined fill text-[20px]">check_circle</span> Profil berhasil disimpan.
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-error-container text-error text-sm">
        <p class="font-semibold flex items-center gap-2"><span class="material-symbols-outlined text-[20px]">error</span> Ada isian yang perlu diperbaiki:</p>
        <ul class="list-disc pl-6 mt-1 space-y-0.5">
            @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('profil.update') }}" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Informasi akun --}}
    <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
        <h2 class="font-bold text-primary text-lg mb-4 flex items-center gap-2"><span class="material-symbols-outlined">account_circle</span> Informasi Akun</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label for="name" class="text-sm font-semibold text-primary">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="{{ $kelas }}">
            </div>
            <div class="space-y-1.5">
                <label for="email" class="text-sm font-semibold text-primary">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="{{ $kelas }}">
            </div>
        </div>
    </section>

    @if ($user->isPelamar())
        {{-- Data pribadi --}}
        <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
            <h2 class="font-bold text-primary text-lg mb-1 flex items-center gap-2"><span class="material-symbols-outlined">badge</span> Data Pribadi</h2>
            <p class="text-sm text-on-surface-variant mb-4">Isi sesuai KTP. Data ini dipakai saat kamu melamar.</p>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="nik" class="text-sm font-semibold text-primary">NIK (16 digit)</label>
                    <input id="nik" name="nik" type="text" inputmode="numeric" maxlength="16" value="{{ $val('nik') }}" placeholder="3578xxxxxxxxxxxx" class="{{ $kelas }}">
                </div>
                <div class="space-y-1.5">
                    <label for="no_whatsapp" class="text-sm font-semibold text-primary">Nomor WhatsApp</label>
                    <input id="no_whatsapp" name="no_whatsapp" type="tel" value="{{ $val('no_whatsapp') }}" placeholder="08xxxxxxxxxx" class="{{ $kelas }}">
                </div>
                <div class="space-y-1.5">
                    <label for="tempat_lahir" class="text-sm font-semibold text-primary">Tempat lahir</label>
                    <input id="tempat_lahir" name="tempat_lahir" type="text" value="{{ $val('tempat_lahir') }}" placeholder="Contoh: Surabaya" class="{{ $kelas }}">
                </div>
                <div class="space-y-1.5">
                    <label for="tanggal_lahir" class="text-sm font-semibold text-primary">Tanggal lahir</label>
                    <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ $tgl }}" class="{{ $kelas }}">
                </div>
                <div class="space-y-1.5">
                    <label for="jenis_kelamin" class="text-sm font-semibold text-primary">Jenis kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="{{ $kelas }}">
                        <option value="">Pilih...</option>
                        <option value="Laki-laki" @selected($val('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected($val('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="status_pernikahan" class="text-sm font-semibold text-primary">Status pernikahan</label>
                    <select id="status_pernikahan" name="status_pernikahan" class="{{ $kelas }}">
                        <option value="">Pilih...</option>
                        @foreach (['Belum Menikah', 'Menikah', 'Lainnya'] as $o)
                            <option value="{{ $o }}" @selected($val('status_pernikahan') === $o)>{{ $o }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5 md:col-span-2">
                    <label for="alamat_domisili" class="text-sm font-semibold text-primary">Alamat domisili</label>
                    <textarea id="alamat_domisili" name="alamat_domisili" rows="2" placeholder="Jl. ..., Kota Surabaya, Jawa Timur" class="w-full px-3 py-2.5 rounded-lg bg-white border border-surface-container placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary transition">{{ $val('alamat_domisili') }}</textarea>
                </div>
            </div>
        </section>

        {{-- Pendidikan --}}
        <section class="p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
            <h2 class="font-bold text-primary text-lg mb-4 flex items-center gap-2"><span class="material-symbols-outlined">school</span> Pendidikan Terakhir</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="jenjang" class="text-sm font-semibold text-primary">Jenjang</label>
                    <select id="jenjang" name="jenjang" class="{{ $kelas }}">
                        <option value="">Pilih...</option>
                        @foreach (['SMA/SMK' => 'SMA / SMK', 'D3' => 'Diploma (D3)', 'S1' => 'Sarjana (S1 / D4)', 'S2' => 'Magister (S2)'] as $k => $o)
                            <option value="{{ $k }}" @selected($val('jenjang') === $k)>{{ $o }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="institusi" class="text-sm font-semibold text-primary">Perguruan tinggi / sekolah</label>
                    <input id="institusi" name="institusi" type="text" value="{{ $val('institusi') }}" placeholder="Contoh: Universitas Airlangga" class="{{ $kelas }}">
                </div>
                <div class="space-y-1.5">
                    <label for="jurusan" class="text-sm font-semibold text-primary">Program studi / jurusan</label>
                    <input id="jurusan" name="jurusan" type="text" value="{{ $val('jurusan') }}" placeholder="Contoh: Manajemen" class="{{ $kelas }}">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="ipk" class="text-sm font-semibold text-primary">IPK</label>
                        <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" value="{{ $val('ipk') }}" placeholder="3.50" class="{{ $kelas }}">
                    </div>
                    <div class="space-y-1.5">
                        <label for="tahun_lulus" class="text-sm font-semibold text-primary">Tahun lulus</label>
                        <input id="tahun_lulus" name="tahun_lulus" type="number" min="1990" value="{{ $val('tahun_lulus') }}" placeholder="2026" class="{{ $kelas }}">
                    </div>
                </div>
                <div class="space-y-1.5 md:col-span-2">
                    <label for="pengalaman_organisasi" class="text-sm font-semibold text-primary">Pengalaman organisasi / kepanitiaan</label>
                    <input id="pengalaman_organisasi" name="pengalaman_organisasi" type="text" value="{{ $val('pengalaman_organisasi') }}" placeholder="BEM Fakultas, Himpunan Mahasiswa, dll." class="{{ $kelas }}">
                </div>
            </div>
        </section>
    @endif

    <div class="flex justify-end">
        <button type="submit" class="px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-primary-container transition-colors flex items-center gap-2 shadow-md">
            <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
        </button>
    </div>
</form>

{{-- Keamanan: ubah kata sandi (memakai route bawaan Breeze) --}}
<section class="mt-8 p-6 rounded-2xl bg-white shadow-sm border border-surface-container">
    <h2 class="font-bold text-primary text-lg mb-1 flex items-center gap-2"><span class="material-symbols-outlined">lock</span> Keamanan</h2>
    <p class="text-sm text-on-surface-variant mb-4">Ubah kata sandi akunmu (minimal 8 karakter).</p>

    @if (session('status') === 'password-updated')
        <div class="mb-4 p-3 rounded-xl bg-emerald-50 text-emerald-800 text-sm flex items-center gap-2">
            <span class="material-symbols-outlined fill text-[20px]">check_circle</span> Kata sandi berhasil diubah.
        </div>
    @endif
    @if ($errors->updatePassword->any())
        <div class="mb-4 p-3 rounded-xl bg-error-container text-error text-sm">
            @foreach ($errors->updatePassword->all() as $e)<p>{{ $e }}</p>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="grid md:grid-cols-3 gap-4 items-end">
        @csrf
        @method('PUT')
        <div class="space-y-1.5">
            <label for="current_password" class="text-sm font-semibold text-primary">Kata sandi sekarang</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password" class="{{ $kelas }}">
        </div>
        <div class="space-y-1.5">
            <label for="password" class="text-sm font-semibold text-primary">Kata sandi baru</label>
            <input id="password" name="password" type="password" autocomplete="new-password" class="{{ $kelas }}">
        </div>
        <div class="space-y-1.5">
            <label for="password_confirmation" class="text-sm font-semibold text-primary">Ulangi kata sandi baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="{{ $kelas }}">
        </div>
        <div class="md:col-span-3 flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-surface-container text-primary font-semibold hover:bg-primary hover:text-white transition-colors">Ubah Kata Sandi</button>
        </div>
    </form>
</section>
@endsection
