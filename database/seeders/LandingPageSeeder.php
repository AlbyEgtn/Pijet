<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPage;
use App\Models\LandingStatistic;
use App\Models\LandingBenefit;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | LANDING PAGE
        |--------------------------------------------------------------------------
        */

        LandingPage::create([
            'hero_title' => 'Bergabung menjadi mitra kami dan dapatkan penghasilan dari menyembuhkan orang.',
            'hero_subtitle' => 'Pijat.in mengingatkan agar selalu menjaga kesehatan tubuh dengan metode Massage, Spa & Pijat.',
            'hero_button_text' => 'Pesan Sekarang',
            'hero_button_link' => '#',

            'app_button_text' => 'Download App',
            'app_button_link' => '#',

            'hero_image' => 'hero.jpg',

            'about_title' => 'Kenapa Memilih Kami?',
            'about_description' => 'Kami menghadirkan layanan refleksi berkualitas dengan terapis profesional yang siap memberikan pengalaman relaksasi terbaik.',
            'about_image' => '1773283201_About.avif',

            'service_title' => 'Layanan Terbaik',
            'service_description' => 'Berbagai layanan refleksi profesional untuk kesehatan tubuh dan pikiran.',

            'therapist_title' => 'Terapis Profesional',
            'therapist_description' => 'Bergabunglah dengan komunitas terapis profesional kami.',

            'join_title' => 'Jadilah Bagian dari Terapis Kami',
            'join_description' => 'Kami membuka kesempatan bagi para terapis profesional untuk bergabung dan berkembang bersama platform kami.',
            'join_image' => 'sm.png',

            'download_title' => 'Download Aplikasi Kami',
            'download_description' => 'Nikmati kemudahan memesan layanan refleksi langsung dari aplikasi mobile kami.',
            'download_image' => '1773369268_Service1.avif',
        ]);


    }
}