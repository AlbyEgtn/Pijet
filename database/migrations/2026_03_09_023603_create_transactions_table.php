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

            // =========================
            // RELASI
            // =========================
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('terapis_id')
                ->nullable()
                ->constrained('terapis')
                ->nullOnDelete();

            // =========================
            // SNAPSHOT CUSTOMER
            // =========================
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_city')->nullable();

            $table->string('orderer_name')->nullable();

            // =========================
            // JADWAL
            // =========================
            $table->date('service_date');
            $table->time('service_time');

            // =========================
            // PAYMENT
            // =========================
            $table->enum('payment_method', [
                'transfer',
                'cash'
            ]);

            $table->enum('payment_status', [
                'pending',      // belum bayar
                'uploaded',     // bukti sudah upload
                'verified',     // sudah dikonfirmasi admin
                'failed',       // ditolak
                'expired'       // kadaluarsa
            ])->default('pending');

            $table->timestamp('payment_uploaded_at')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            $table->timestamp('payment_expired_at')->nullable();

            $table->string('payment_proof')->nullable();

            // =========================
            // ORDER STATUS (CORE FLOW)
            // =========================
            $table->enum('order_status', [
                'waiting',      // menunggu pembayaran
                'ready',        // siap diambil terapis
                'assigned',     // sudah diambil terapis
                'on_the_way',   // terapis menuju lokasi
                'ongoing',      // sedang pijat
                'completed',    // selesai
                'cancelled',    // dibatalkan
                'rescheduled'   // dijadwal ulang
            ])->default('waiting');

            // =========================
            // HARGA
            // =========================
            $table->integer('total_price')->default(0);

            // =========================
            // RESCHEDULE
            // =========================
            $table->date('reschedule_date')->nullable();
            $table->time('reschedule_time')->nullable();

            // =========================
            // CANCEL
            // =========================
            $table->text('cancel_reason')->nullable();

            // =========================
            // EXPIRED ORDER
            // =========================
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};