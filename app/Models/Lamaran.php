<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lamaran extends Model
{
    protected $table = 'lamaran';
    protected $guarded = [];

    /** Daftar status pendaftaran (berlaku untuk lamaran kerja maupun magang). */
    public const STATUS = [
        'menunggu'           => 'Menunggu',
        'ditinjau'           => 'Sedang Ditinjau',
        'lolos_administrasi' => 'Lolos Administrasi',
        'tidak_lolos'        => 'Tidak Lolos',
        'tahap_seleksi'      => 'Tahap Seleksi',
        'diterima'           => 'Diterima',
    ];

    public const KETERANGAN = [
        'menunggu'           => 'Pendaftaran baru masuk',
        'ditinjau'           => 'Dokumen sedang diperiksa HRD',
        'lolos_administrasi' => 'Lolos pemeriksaan dokumen',
        'tidak_lolos'        => 'Tidak memenuhi kriteria',
        'tahap_seleksi'      => 'Mengikuti tahapan seleksi berikutnya',
        'diterima'           => 'Dinyatakan diterima',
    ];

    public function statusLabel(): string
    {
        return self::STATUS[$this->status] ?? $this->status;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function cabangPilihan(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'cabang_pilihan_id');
    }

    public function dokumen(): HasMany
    {
        return $this->hasMany(DokumenLamaran::class);
    }

    public function wawancara(): HasOne
    {
        return $this->hasOne(Wawancara::class)->latestOfMany();
    }
}
