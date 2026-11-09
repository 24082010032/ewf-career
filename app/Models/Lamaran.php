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
