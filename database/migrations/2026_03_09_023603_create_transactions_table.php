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

            // relasi customer
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('terapis_id')
                ->nullable()
                ->constrained('terapis')
                ->nullOnDelete();

            // data customer snapshot
            $table->string('customer_name');

            $table->string('customer_phone')->nullable();

            $table->text('customer_address')->nullable();

            $table->string('customer_city')->nullable();

            // pemesan
            $table->string('orderer_name')->nullable();

            // jadwal layanan
            $table->date('service_date');

            $table->time('service_time');

            // metode pembayaran
            $table->enum('payment_method',[
                'transfer',
                'cash'
            ]);

            $table->timestamp('payment_expired_at')->nullable();

            $table->timestamp('payment_uploaded_at')->nullable();

            $table->string('payment_proof')->nullable();

            // status transaksi
            $table->enum('status',[
                'lunas',
                'proses',
                'belum_lunas',
                'dibatalkan',
                'reschedule'
            ])->default('belum_lunas');

            // total harga
            $table->integer('total_price')->default(0);

            // reschedule
            $table->date('reschedule_date')->nullable();

            $table->time('reschedule_time')->nullable();

            // cancel reason
            $table->text('cancel_reason')->nullable();

            $table->timestamps();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};