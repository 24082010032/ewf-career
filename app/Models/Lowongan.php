<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $guarded = [];

    protected $casts = ['batas_lamaran' => 'date'];

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

    public function lamaran(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }

    // Lowongan yang masih dibuka & belum lewat batas tanggal
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'buka')
                     ->whereDate('batas_lamaran', '>=', now());
    }
}
