<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed all admin accounts with correct roles.
     *
     * SUPER ADMIN  — Full access to everything including System Settings
     * ADMIN        — Manages users, applications, payments, content
     * MODERATOR    — Reviews applications and content only
     */
    public function run(): void
    {
        // ──────────────────────────────────────────────────
        // SUPER ADMIN
        // ──────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'superadmin@kodenest.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('SuperK0de#2025!'),
                'role'     => User::ROLE_SUPER_ADMIN,
            ]
        );

        // ──────────────────────────────────────────────────
        // ADMIN
        // ──────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@kodenest.com'],
            [
                'name'     => 'KodeNest Admin',
                'password' => Hash::make('Adm!nK0de#2025'),
                'role'     => User::ROLE_ADMIN,
            ]
        );

        // ──────────────────────────────────────────────────
        // MODERATOR / REVIEWER
        // ──────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'reviewer@kodenest.com'],
            [
                'name'     => 'KodeNest Reviewer',
                'password' => Hash::make('Rev!ewK0de#2025'),
                'role'     => User::ROLE_MODERATOR,
            ]
        );
    }
}
