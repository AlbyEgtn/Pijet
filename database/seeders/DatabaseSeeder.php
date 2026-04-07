<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TransactionSeeder::class,
            LandingPageSeeder::class,
            LandingStatisticSeeder::class,
            LandingBenefitSeeder::class,
            ServiceSeeder::class,
            CitySeeder::class,
            CabangSeeder::class,
            PaymentAccountSeeder::class,
            KaryawanSeeder::class,
        ]);
    }
}
