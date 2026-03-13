<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingBenefit;

class LandingBenefitSeeder extends Seeder
{
    public function run(): void
    {
        LandingBenefit::insert([

            [
                'title' => 'Penghasilan Fleksibel',

                'description' =>
                    'Atur jadwal kerja sendiri dan dapatkan penghasilan tambahan dari layanan pijat profesional.',

                'icon' => 'currency-dollar'
            ],

            [
                'title' => 'Platform Profesional',

                'description' =>
                    'Bekerja dalam ekosistem digital yang memudahkan manajemen pemesanan.',

                'icon' => 'device-phone-mobile'
            ],

            [
                'title' => 'Pelatihan & Pengembangan',

                'description' =>
                    'Kami menyediakan pelatihan berkala untuk meningkatkan teknik pijat.',

                'icon' => 'academic-cap'
            ],

            [
                'title' => 'Keamanan Terjamin',

                'description' =>
                    'Sistem verifikasi dan dukungan keamanan untuk setiap terapis.',

                'icon' => 'shield-check'
            ],

            [
                'title' => 'Jangkauan Luas',

                'description' =>
                    'Akses ke ribuan pelanggan aktif setiap harinya.',

                'icon' => 'users'
            ],

            [
                'title' => 'Proses Mudah',

                'description' =>
                    'Pendaftaran cepat dan onboarding yang mudah.',

                'icon' => 'arrow-right'
            ]

        ]);
    }
}