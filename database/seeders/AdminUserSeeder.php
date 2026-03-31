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
        // 🔴 DEVELOPER: CHANGE DEFAULT PASSWORDS HERE
        // When deploying, change these or update via UI immediately.
        // ──────────────────────────────────────────────────
        $superAdminPassword = 'SuperK0de#2025!';
        $adminPassword      = 'Adm!nK0de#2025';
        $reviewerPassword   = 'Rev!ewK0de#2025';

        // NOTE: We do NOT use Hash::make() here because the User model
        // has 'password' => 'hashed' in its $casts array, which automatically
        // hashes it on assignment. Using Hash::make() would double-hash it!

        // ──────────────────────────────────────────────────
        // SUPER ADMIN
        // ──────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'superadmin@kodenest.com'],
            [
                'name'     => 'Super Admin',
                'password' => $superAdminPassword,
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
                'password' => $adminPassword,
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
                'password' => $reviewerPassword,
                'role'     => User::ROLE_MODERATOR,
            ]
        );
    }
}
