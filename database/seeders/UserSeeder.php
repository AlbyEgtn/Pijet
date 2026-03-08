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
                'role' => 'super_admin'
            ],

            [
                'name' => 'Admin',
                'email' => 'admin@pijet.in',
                'password' => 'password',
                'role' => 'admin'
            ],

            [
                'name' => 'Finance',
                'email' => 'finance@pijet.in',
                'password' => 'password',
                'role' => 'finance'
            ],

            [
                'name' => 'Terapis',
                'email' => 'terapis@pijet.in',
                'password' => 'password',
                'role' => 'terapis'
            ],

            [
                'name' => 'Customer',
                'email' => 'customer@pijet.in',
                'password' => 'password',
                'role' => 'customer'
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