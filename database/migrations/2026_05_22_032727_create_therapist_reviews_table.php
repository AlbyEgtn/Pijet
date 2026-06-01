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
        Schema::create('therapist_reviews', function (Blueprint $table) {

            $table->id();

            // customer yang memberi review
            $table->foreignId('customer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // therapist yang direview
            $table->foreignId('therapist_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // rating 1-5
            $table->unsignedTinyInteger('rating');

            // komentar
            $table->text('review')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_reviews');
    }
};
