<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Terapis\Terapis;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ======================
        // DEFAULT USER
        // ======================
        $users = [

            [
                'name' => 'Super Admin',
                'email' => 'superadmin@pijet.in',
                'password' => Hash::make('password'),
                'role' => 'super_admin'
            ],

            [
                'name' => 'Admin',
                'email' => 'admin@pijet.in',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],

            [
                'name' => 'Finance',
                'email' => 'finance@pijet.in',
                'password' => Hash::make('password'),
                'role' => 'finance'
            ],

            [
                'name' => 'Terapis Default',
                'email' => 'terapis@pijet.in',
                'password' => Hash::make('password'),
                'role' => 'terapis'
            ],

            [
                'name' => 'Customer Default',
                'email' => 'customer@pijet.in',
                'password' => Hash::make('password'),
                'role' => 'customer'
            ],

        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }

        for ($i = 1; $i <= 6; $i++) {

            User::updateOrCreate(
                ['email' => 'customer'.$i.'@gmail.com'],
                [
                    'name' => 'Customer ' . $i,
                    'password' => Hash::make('123456'),
                    'role' => 'customer',

                    'nik' => '3178'.rand(1000000000,9999999999),
                    'gender' => $i % 2 ? 'L' : 'P',
                    'birth_date' => '2000-01-'.rand(10,28),
                    'phone' => '08123'.rand(100000,999999),

                    'city' => 'Jakarta',
                    'address' => 'Jl. Customer No '.$i,

                    // 🔥 TAMBAHAN BIAR MUNCUL DI DETAIL
                    'ktp' => 'ktp/sample.jpg',
                ]
            );
        }

        for ($i = 1; $i <= 6; $i++) {

            $user = User::updateOrCreate(
                ['email' => 'terapis'.$i.'@gmail.com'],
                [
                    'name' => 'Terapis ' . $i,
                    'password' => Hash::make('123456'),
                    'role' => 'terapis',

                    'nik' => '3201'.rand(1000000000,9999999999),
                    'gender' => $i % 2 ? 'L' : 'P',
                    'birth_date' => '1995-02-'.rand(10,28),
                    'phone' => '08213'.rand(100000,999999),

                    'city' => 'Bandung',
                    'address' => 'Jl. Terapis No '.$i,

                    'ktp' => 'ktp/sample.png',
                ]
            );

            Terapis::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => $user->nik,
                    'gender' => $user->gender,
                    'whatsapp' => $user->phone,
                    'address' => $user->address,
                    'bank_name' => 'BCA',
                    'bank_number' => rand(10000000,99999999),
                    'total_orders' => rand(10,50),
                    'balance' => rand(200000,800000),
                    'status' => 1,
                ]
            );
        }
    }
}