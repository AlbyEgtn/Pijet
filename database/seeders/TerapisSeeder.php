<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Terapis;

class TerapisSeeder extends Seeder
{
    public function run(): void
    {
        // ambil semua user dengan role terapis
        $users = User::where('role', 'terapis')->get();

        foreach ($users as $user) {

            Terapis::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => '0000000000000000',
                    'gender' => 'L',
                    'whatsapp' => '08xxxxxxxxxx',
                    'address' => 'Alamat default',
                    'bank_name' => 'BCA',
                    'bank_number' => '1234567890',
                    'total_orders' => 0,
                    'balance' => 0,
                    'status' => 1
                ]
            );

        }
    }
}