<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Missing columns identified as the cause of QueryException
            $table->foreignId('student_id')->nullable()->after('id')->constrained('students')->cascadeOnDelete();
            $table->decimal('amount', 12, 2)->after('student_id');
            $table->string('status')->default('pending')->after('amount');
            $table->string('type')->nullable()->after('status'); // Payment method (e.g., Transfer, Card)
            $table->string('reference')->nullable()->after('type'); // Transaction reference
            $table->text('notes')->nullable()->after('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn(['student_id', 'amount', 'status', 'type', 'reference', 'notes']);
        });
    }
};
