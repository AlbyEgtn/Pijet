<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            [
                'name' => 'Super Admin',
                'email' => 'superadmin@pijet.in',
                'password' => 'password',
                'role' => 'super_admin',
                'verification_status' => 'approved'
            ],

            [
                'name' => 'Admin',
                'email' => 'admin@pijet.in',
                'password' => 'password',
                'role' => 'admin',
                'verification_status' => 'approved'

            ],

            [
                'name' => 'Finance',
                'email' => 'finance@pijet.in',
                'password' => 'password',
                'role' => 'finance',
                'verification_status' => 'approved'

            ],

            [
                'name' => 'Terapis',
                'email' => 'terapis@pijet.in',
                'password' => 'password',
                'role' => 'terapis',
                'verification_status' => 'approved'
            ],

            [
                'name' => 'Customer',
                'email' => 'customer@pijet.in',
                'password' => 'password',
                'role' => 'customer',
                'verification_status' => 'approved'
            ],

        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // unique key
                $user
            );
        }
    }
}