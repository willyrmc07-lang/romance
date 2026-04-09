<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Properti yang bisa diisi secara massal (Mass Assignment).
     * Pastikan role_id dan branch_id ada di sini.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'branch_id',
    ];

    /**
     * Atribut yang harus disembunyikan untuk serialisasi (API/JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke model Role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi ke model Branch (Cabang).
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}