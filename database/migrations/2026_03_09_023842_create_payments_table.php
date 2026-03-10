<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('transaction_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // bank
            $table->string('bank_name')->nullable();

            $table->string('account_number')->nullable();

            $table->string('account_holder')->nullable();

            // bukti pembayaran
            $table->string('payment_proof')->nullable();

            // waktu pembayaran
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};