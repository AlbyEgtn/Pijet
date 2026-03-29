<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terapis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nik')->nullable();
            $table->string('gender')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
     
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();

            $table->integer('total_orders')->default(0);
            $table->integer('balance')->default(0);

            $table->boolean('status')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terapis');
    }
};