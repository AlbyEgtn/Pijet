<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionService;
use App\Models\Payment;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ SESUAI DENGAN MIGRATION KAMU
        $customers = User::where('role', 'customer')->take(5)->get();
        $therapists = User::where('role', 'terapis')->take(2)->get();

        $therapist1 = $therapists->get(0)?->id;
        $therapist2 = $therapists->get(1)?->id;

        $transactions = [
            [
                'code' => 'TRS0001',
                'payment_method' => 'transfer',
                'payment_status' => 'verified',
                'order_status' => 'completed'
            ],
            [
                'code' => 'TRS0002',
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'order_status' => 'waiting'
            ],
            [
                'code' => 'TRS0003',
                'payment_method' => 'transfer',
                'payment_status' => 'failed',
                'order_status' => 'cancelled'
            ],
            [
                'code' => 'TRS0004',
                'payment_method' => 'transfer',
                'payment_status' => 'verified',
                'order_status' => 'rescheduled'
            ],
            [
                'code' => 'TRS0005',
                'payment_method' => 'cash',
                'payment_status' => 'verified',
                'order_status' => 'completed'
            ]
        ];

        foreach ($transactions as $data) {

            $customer = $customers->random();

            $trx = Transaction::create([
                'transaction_code' => $data['code'],

                // RELASI
                'customer_id' => $customer->id,
                'terapis_id' => $therapist1,

                // SNAPSHOT
                'customer_name' => $customer->name,
                'customer_phone' => $customer->phone ?? '081234567890',
                'customer_address' => $customer->address ?? 'Yogyakarta',
                'customer_city' => $customer->city ?? 'Yogyakarta',
                'orderer_name' => $customer->name,

                // JADWAL
                'service_date' => now()->addDays(rand(1,5)),
                'service_time' => '09:30:00',

                // PAYMENT
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_status'],
                'payment_uploaded_at' => in_array($data['payment_status'], ['uploaded','verified']) ? now()->subHours(2) : null,
                'payment_verified_at' => $data['payment_status'] === 'verified' ? now()->subHour() : null,
                'payment_expired_at' => $data['payment_status'] === 'expired' ? now()->subDay() : null,
                'payment_proof' => $data['payment_method'] === 'transfer' ? 'bukti_transfer.jpg' : null,

                // STATUS
                'order_status' => $data['order_status'],

                // PRICE
                'total_price' => rand(200000,700000),

                // RESCHEDULE
                'reschedule_date' => $data['order_status'] === 'rescheduled' ? now()->addDays(3) : null,
                'reschedule_time' => $data['order_status'] === 'rescheduled' ? '14:00:00' : null,

                // CANCEL
                'cancel_reason' => $data['order_status'] === 'cancelled'
                    ? 'Customer membatalkan pesanan'
                    : null,

                // EXPIRED
                'expired_at' => $data['payment_status'] === 'expired'
                    ? now()->addHours(24)
                    : null
            ]);

            // ✅ SERVICES
            TransactionService::create([
                'transaction_id' => $trx->id,
                'service_name' => 'Full Body Massage',
                'therapist_id' => $therapist1,
                'duration' => 60,
                'service_price' => 150000,
                'additional_service' => 'Kerokan',
                'additional_price' => 10000,
                'total_duration' => 70
            ]);

            TransactionService::create([
                'transaction_id' => $trx->id,
                'service_name' => 'Hot Stone Massage',
                'therapist_id' => $therapist2,
                'duration' => 90,
                'service_price' => 200000,
                'additional_service' => 'Refleksi',
                'additional_price' => 10000,
                'total_duration' => 100
            ]);

            // ✅ PAYMENT
            Payment::create([
                'transaction_id' => $trx->id,
                'bank_name' => $data['payment_method'] === 'transfer' ? 'BCA' : null,
                'account_number' => $data['payment_method'] === 'transfer' ? '733801013479531' : null,
                'account_holder' => $customer->name,
                'paid_at' => $data['payment_status'] === 'verified' ? now() : null
            ]);
        }
    }
}