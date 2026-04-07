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
        Schema::create('therapist_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Kemampuan
            $table->integer('experience_years')->nullable();
            $table->text('skills')->nullable(); // teknik pijat
            $table->text('certifications')->nullable();
            $table->boolean('handle_special_condition')->default(false);

            // Ketersediaan
            $table->string('work_days')->nullable(); // contoh: Senin-Jumat
            $table->string('work_hours')->nullable(); // contoh: 08:00-17:00
            $table->boolean('is_mobile')->default(false);
            $table->string('coverage_area')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_profiles');
    }
};
