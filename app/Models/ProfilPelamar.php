<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilPelamar extends Model
{
    protected $table = 'profil_pelamar';
    protected $guarded = [];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
