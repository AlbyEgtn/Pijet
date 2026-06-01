<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('therapist_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // ======================
            // KEMAMPUAN
            // ======================

            $table->unsignedInteger('experience_years');

            $table->text('skills');

            $table->text('certifications');

            $table->boolean('handle_special_condition')
                ->default(false);

            // ======================
            // KETERSEDIAAN
            // ======================

            // simpan array hari kerja
            $table->json('work_days');

            // jam mulai & selesai
            $table->json('work_shifts');

            // ======================
            // KOTA
            // ======================

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapist_profiles');
    }
};