<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('transaction_services', function (Blueprint $table) {

            $table->id();

            $table->foreignId('transaction_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // layanan utama
            $table->string('service_name');

            $table->integer('duration'); // menit

            $table->integer('service_price');

            // terapis (relasi ke users)
            $table->foreignId('therapist_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // layanan tambahan
            $table->string('additional_service')->nullable();

            $table->integer('additional_price')->nullable();

            // total durasi
            $table->integer('total_duration');

            $table->timestamps();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_services');
    }
};