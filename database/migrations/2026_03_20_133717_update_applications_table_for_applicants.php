<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clear existing applications to avoid foreign key integrity issues 
        // with the new applicant_id column in this dev environment.
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('applications')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'applicant_id')) {
                $table->foreignId('applicant_id')->after('id')->nullable()->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('applications', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('status');
            }
            
            $columnsToDrop = array_intersect(['first_name', 'last_name', 'email', 'phone', 'address'], Schema::getColumnListing('applications'));
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });

        // Make it non-nullable now that it's clear
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('applicant_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['applicant_id']);
            $table->dropColumn(['applicant_id', 'rejection_reason']);
            
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
        });
    }
};
