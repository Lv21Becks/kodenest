<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    const ROLE_USER = 'user';
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_FINANCE_ADMIN = 'finance_admin';
    const ROLE_INSTRUCTOR = 'instructor';
    const ROLE_ADMISSIONS = 'admissions_officer';
    const ROLE_SUPPORT = 'support_staff';

    /**
     * Check if user is any kind of admin
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, [
            self::ROLE_SUPER_ADMIN,
            self::ROLE_FINANCE_ADMIN,
            self::ROLE_INSTRUCTOR, // Instructors might need admin panel access
            self::ROLE_ADMISSIONS,
            self::ROLE_SUPPORT,
            'admin' // legacy support
        ]);
    }

    public function hasRole($role): bool
    {
        return $this->role === $role || $this->role === self::ROLE_SUPER_ADMIN; // Super admin has all roles
    }
}
