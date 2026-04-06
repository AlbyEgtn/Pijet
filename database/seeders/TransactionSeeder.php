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

        // 🔥 AMBIL CUSTOMER DARI DATABASE
        $customers = User::where('role', 'customer')->get();

        // 🔥 FIX ROLE TERAPIS (SESUAI SISTEM KAMU)
        $therapists = User::where('role', 'terapis')->take(2)->get();

        $therapist1 = $therapists->get(0)?->id;
        $therapist2 = $therapists->get(1)?->id;


        $transactions = [

            ['code' => 'TRS0001','status' => 'lunas','payment' => 'transfer'],
            ['code' => 'TRS0002','status' => 'belum_lunas','payment' => 'cash'],
            ['code' => 'TRS0003','status' => 'dibatalkan','payment' => 'transfer'],
            ['code' => 'TRS0004','status' => 'reschedule','payment' => 'transfer'],
            ['code' => 'TRS0005','status' => 'lunas','payment' => 'cash']

        ];


        foreach ($transactions as $data) {

            // 🔥 PILIH CUSTOMER RANDOM
            $customer = $customers->random();

            $trx = Transaction::create([

                'transaction_code' => $data['code'],

                // 🔥 WAJIB ADA
                'customer_id' => $customer->id,

                // 🔥 AMBIL DARI USER
                'customer_name' => $customer->name,
                'customer_phone' => $customer->phone ?? '081234567890',
                'customer_address' => $customer->address ?? 'Yogyakarta',
                'customer_city' => $customer->city ?? 'Yogyakarta',

                'orderer_name' => $customer->name,

                'service_date' => now()->addDays(rand(1,5)),
                'service_time' => '09:30:00',

                'payment_method' => $data['payment'],
                'status' => $data['status'],

                'total_price' => rand(200000,700000),

                'reschedule_date' => $data['status'] == 'reschedule'
                    ? now()->addDays(3)
                    : null,

                'reschedule_time' => $data['status'] == 'reschedule'
                    ? '14:00:00'
                    : null,

                'cancel_reason' => $data['status'] == 'dibatalkan'
                    ? 'Customer membatalkan pesanan'
                    : null

            ]);


            /*
            |------------------------------------------------------------------
            | SERVICES
            |------------------------------------------------------------------
            */

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


            /*
            |------------------------------------------------------------------
            | PAYMENT
            |------------------------------------------------------------------
            */

            Payment::create([
                'transaction_id' => $trx->id,
                'bank_name' => $data['payment'] == 'transfer' ? 'BCA' : null,
                'account_number' => $data['payment'] == 'transfer' ? '7338-01-013479-53-1' : null,
                'account_holder' => $data['payment'] == 'transfer' ? $customer->name : null,
                'paid_at' => $data['status'] == 'lunas' ? now() : null
            ]);

        }

    }
}