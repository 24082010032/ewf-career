<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenLamaran extends Model
{
    protected $table = 'dokumen_lamaran';
    protected $guarded = [];

    public function lamaran(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class);
    }
}
