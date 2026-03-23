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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'learning_mode')) {
                $table->string('learning_mode')->default('online')->nullable();
            }
            if (!Schema::hasColumn('students', 'amount_paid')) {
                $table->decimal('amount_paid', 10, 2)->default(0)->nullable();
            }
            if (!Schema::hasColumn('students', 'progress')) {
                $table->integer('progress')->default(0)->nullable();
            }
            if (!Schema::hasColumn('students', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('students', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
