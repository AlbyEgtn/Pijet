<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionService;
use App\Models\Payment;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {

        $transactions = [

            [
                'code' => 'TRS0001',
                'customer' => 'Matt Shadows',
                'status' => 'lunas',
                'payment' => 'transfer'
            ],

            [
                'code' => 'TRS0002',
                'customer' => 'Yance Widiasuti',
                'status' => 'belum_lunas',
                'payment' => 'cash'
            ],

            [
                'code' => 'TRS0003',
                'customer' => 'Emily Armstrong',
                'status' => 'dibatalkan',
                'payment' => 'transfer'
            ],

            [
                'code' => 'TRS0004',
                'customer' => 'Amy Lee',
                'status' => 'reschedule',
                'payment' => 'transfer'
            ],

            [
                'code' => 'TRS0005',
                'customer' => 'Syn Gates',
                'status' => 'lunas',
                'payment' => 'cash'
            ]

        ];



        foreach($transactions as $data){

            $trx = Transaction::create([

                'transaction_code' => $data['code'],

                'customer_name' => $data['customer'],

                'customer_phone' => '081234567890',

                'customer_address' => 'Bantul, Yogyakarta',

                'customer_city' => 'Yogyakarta',

                'orderer_name' => $data['customer'],

                'service_date' => now()->addDays(rand(1,5)),

                'service_time' => '09:30:00',

                'payment_method' => $data['payment'],

                'status' => $data['status'],

                'total_price' => rand(200000,700000),

                'reschedule_date' => $data['status'] == 'reschedule' ? now()->addDays(3) : null,

                'reschedule_time' => $data['status'] == 'reschedule' ? '14:00:00' : null,

                'cancel_reason' => $data['status'] == 'dibatalkan' ? 'Customer membatalkan pesanan' : null

            ]);



            /*
            |--------------------------------------------------------------------------
            | SERVICES
            |--------------------------------------------------------------------------
            */

            TransactionService::create([

                'transaction_id' => $trx->id,

                'service_name' => 'Full Body Massage',

                'therapist_name' => 'Amy Lee',

                'duration' => 60,

                'service_price' => 150000,

                'additional_service' => 'Kerokan',

                'additional_price' => 10000,

                'total_duration' => 70

            ]);


            TransactionService::create([

                'transaction_id' => $trx->id,

                'service_name' => 'Hot Stone Massage',

                'therapist_name' => 'Syn Gates',

                'duration' => 90,

                'service_price' => 200000,

                'additional_service' => 'Refleksi',

                'additional_price' => 10000,

                'total_duration' => 100

            ]);



            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            Payment::create([

                'transaction_id' => $trx->id,

                'bank_name' => $data['payment'] == 'transfer' ? 'BCA' : null,

                'account_number' => $data['payment'] == 'transfer' ? '7338-01-013479-53-1' : null,

                'account_holder' => $data['payment'] == 'transfer' ? 'Yance Widiasuti' : null,

                'paid_at' => $data['status'] == 'lunas' ? now() : null

            ]);

        }

    }
}