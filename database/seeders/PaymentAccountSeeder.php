<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentAccount;

class PaymentAccountSeeder extends Seeder
{
    public function run(): void
    {
        PaymentAccount::insert([
            [
                'bank_name' => 'BCA',
                'account_number' => '1234567890',
                'account_holder' => 'PT Sehat Selalu',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'bank_name' => 'Mandiri',
                'account_number' => '9876543210',
                'account_holder' => 'PT Sehat Selalu',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'bank_name' => 'BRI',
                'account_number' => '1122334455',
                'account_holder' => 'PT Sehat Selalu',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}