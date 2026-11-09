<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wawancara extends Model
{
    protected $table = 'wawancara';
    protected $guarded = [];

    protected $casts = [
        'waktu' => 'datetime',
        'dikonfirmasi' => 'boolean',
    ];

    public function lamaran(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class);
    }
}
