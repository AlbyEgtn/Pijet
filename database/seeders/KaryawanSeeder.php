<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SuperAdmin\Cabang;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        // ambil semua cabang aktif
        $cabangs = Cabang::where('status', 'Aktif')->get();

        if ($cabangs->isEmpty()) {
            $this->command->warn('Cabang kosong, jalankan CabangSeeder dulu!');
            return;
        }

        // ======================
        // ADMIN & FINANCE DUMMY
        // ======================
        for ($i = 1; $i <= 10; $i++) {

            $cabang = $cabangs->random();

            User::updateOrCreate(
                ['email' => "karyawan$i@gmail.com"],
                [
                    'name' => "Karyawan $i",
                    'email' => "karyawan$i@gmail.com",
                    'password' => Hash::make('123456'),
                    'role' => $i % 2 == 0 ? 'admin' : 'finance',

                    'phone' => '08123'.rand(100000,999999),
                    'cabang_id' => $cabang->id,

                    // IDENTITAS
                    'gender' => $i % 2 ? 'L' : 'P',
                    'birth_date' => '1990-0'.rand(1,9).'-'.rand(10,28),
                    'address' => 'Jl. Karyawan No '.$i,
                    'city' => $cabang->kota,

                    'foto' => null,
                ]
            );
        }
    }
}