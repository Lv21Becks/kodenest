<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Force linking storage (this fixes the broken images issue on Laravel Cloud)
        try {
            Artisan::call('storage:link');
        } catch (\Exception $e) {
            // Ignore if already linked or fails
        }

        // 2. Re-seed Admin users (this fixes the login credentials issue on Laravel Cloud)
        try {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\AdminUserSeeder',
                '--force' => true,
            ]);
        } catch (\Exception $e) {
            // Log it or ignore
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
