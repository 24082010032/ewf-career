<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabang extends Model
{
    protected $table = 'cabang';
    protected $guarded = [];

    public function lowongan(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }
}
