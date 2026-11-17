<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isHrd(): bool     { return $this->role === 'hrd'; }
    public function isPelamar(): bool { return $this->role === 'pelamar'; }

    public function roleLabel(): string
    {
        return match ($this->role) {
            'admin' => 'Admin',
            'hrd'   => 'HRD / Recruiter',
            default => 'Pelamar',
        };
    }

    /** Dasbor milik role ini. */
    public function dashboardUrl(): string
    {
        return match ($this->role) {
            'admin' => route('admin.dasbor'),
            'hrd'   => route('hrd.dasbor'),
            default => route('pelamar.dasbor'),
        };
    }

    /** Halaman tujuan setelah login: pelamar ke Beranda utama, admin/HRD ke dasbornya. */
    public function landingUrl(): string
    {
        return $this->isPelamar() ? route('home') : $this->dashboardUrl();
    }

    public function profil(): HasOne
    {
        return $this->hasOne(ProfilPelamar::class);
    }

    public function lamaran(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class);
    }
}
