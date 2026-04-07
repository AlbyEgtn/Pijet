<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            $table->string('transaction_code')->unique();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('terapis_id')
                ->nullable()
                ->constrained('terapis')
                ->nullOnDelete();

            // ❌ HAPUS after()
            $table->foreignId('company_account_id')
                ->nullable()
                ->constrained('payment_accounts')
                ->nullOnDelete();

            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_city')->nullable();

            $table->string('orderer_name')->nullable();

            $table->date('service_date');
            $table->time('service_time');

            $table->enum('payment_method', ['transfer','cash']);

            $table->enum('payment_status', [
                'pending','uploaded','verified','failed','expired'
            ])->default('pending');

            $table->timestamp('payment_uploaded_at')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            $table->timestamp('payment_expired_at')->nullable();

            $table->string('payment_proof')->nullable();

            $table->enum('order_status', [
                'waiting','ready','assigned','on_the_way',
                'ongoing','completed','cancelled','rescheduled'
            ])->default('waiting');

            $table->integer('total_price')->default(0);

            $table->date('reschedule_date')->nullable();
            $table->time('reschedule_time')->nullable();

            $table->text('cancel_reason')->nullable();

            // 🔥 TAMBAHAN BISNIS
            $table->integer('company_income')->nullable();
            $table->integer('therapist_income')->nullable();
            $table->boolean('is_balance_recorded')->default(false);
            $table->boolean('is_profit_shared')->default(false);

            $table->timestamp('expired_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};