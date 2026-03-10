<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {

        /* ========================
           LAYANAN UTAMA
        ======================== */

        Service::create([
            'name' => 'Full Body Massage',
            'description' => 'Pijat relaksasi seluruh tubuh untuk mengurangi stres dan meningkatkan sirkulasi darah.',
            'price' => 150000,
            'duration' => 90,
            'image' => 'services/Seed1.jpg',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Thai Massage',
            'description' => 'Teknik peregangan khas Thailand untuk meningkatkan fleksibilitas tubuh.',
            'price' => 130000,
            'duration' => 60,
            'image' => 'services/Seed1.jpg',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Hot Stone Massage',
            'description' => 'Pijat menggunakan batu panas untuk meredakan ketegangan otot.',
            'price' => 170000,
            'duration' => 90,
            'image' => 'services/Seed1.jpg',
            'is_additional' => 0,
            'is_active' => 1
        ]);



        /* ========================
           LAYANAN TAMBAHAN
        ======================== */

        Service::create([
            'name' => 'Aromatherapy Oil',
            'description' => 'Minyak aromaterapi untuk meningkatkan relaksasi selama pijat.',
            'price' => 25000,
            'duration' => 10,
            'image' => null,
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Hot Stone Add-on',
            'description' => 'Tambahan terapi batu panas pada layanan pijat.',
            'price' => 30000,
            'duration' => 20,
            'image' => null,
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Body Scrub',
            'description' => 'Scrub tubuh untuk mengangkat sel kulit mati.',
            'price' => 35000,
            'duration' => 10,
            'image' => null,
            'is_additional' => 1,
            'is_active' => 1
        ]);

    }
}