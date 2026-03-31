<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('email')->unique();

            $table->timestamp('email_verified_at')->nullable();

            $table->enum('role', [
                'super_admin',
                'admin',
                'finance',
                'terapis',
                'customer'
            ])->default('customer');

            $table->string('nik')->nullable();

            $table->enum('gender',['L','P'])->nullable();

            $table->date('birth_date')->nullable();

            $table->string('phone')->nullable();

            $table->string('city')->nullable();

            $table->text('address')->nullable();

            $table->string('work_area')->nullable();

            $table->string('ktp')->nullable();

            $table->string('skck')->nullable();

            $table->string('password');

            $table->string('email_otp')->nullable();

            $table->timestamp('otp_expired_at')->nullable();

            $table->string('reset_otp')->nullable();

            $table->timestamp('reset_otp_expired_at')->nullable();

            // STATUS VERIFIKASI
            $table->enum('verification_status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            // ALASAN REJECT
            $table->string('reject_reason')->nullable()->after('verification_status');

            // WAKTU VERIFIKASI
            $table->timestamp('verified_at')->nullable();

            // ADMIN YANG VERIFIKASI
            $table->foreignId('verified_by')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->rememberToken();

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {

            $table->string('email')->primary();

            $table->string('token');

            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {

            $table->string('id')->primary();

            $table->foreignId('user_id')->nullable()->index();

            $table->string('ip_address',45)->nullable();

            $table->text('user_agent')->nullable();

            $table->longText('payload');

            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};