<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable, MustVerifyEmail;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'is_admin',
        'is_blocked'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}
