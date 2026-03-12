<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {

        /* ========================
           LAYANAN UTAMA (10)
        ======================== */

        Service::create([
            'name' => 'Full Body Massage',
            'description' => 'Pijat relaksasi seluruh tubuh untuk mengurangi stres dan meningkatkan sirkulasi darah.',
            'price' => 150000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Thai Massage',
            'description' => 'Teknik peregangan khas Thailand untuk meningkatkan fleksibilitas tubuh.',
            'price' => 130000,
            'duration' => 60,
            'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Hot Stone Massage',
            'description' => 'Pijat menggunakan batu panas untuk meredakan ketegangan otot.',
            'price' => 170000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1600334129128-685c5582fd35',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Traditional Massage',
            'description' => 'Pijat tradisional untuk meredakan pegal dan meningkatkan energi tubuh.',
            'price' => 140000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Deep Tissue Massage',
            'description' => 'Pijat fokus pada jaringan otot dalam untuk meredakan nyeri kronis.',
            'price' => 180000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Swedish Massage',
            'description' => 'Pijat lembut untuk relaksasi tubuh dan pikiran.',
            'price' => 150000,
            'duration' => 60,
            'image' => 'https://images.unsplash.com/photo-1552693673-1bf958298935',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Reflexology Massage',
            'description' => 'Pijat titik refleksi pada kaki untuk meningkatkan kesehatan tubuh.',
            'price' => 120000,
            'duration' => 60,
            'image' => 'https://images.unsplash.com/photo-1588776814546-daab30f310ce',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Balinese Massage',
            'description' => 'Teknik pijat khas Bali dengan tekanan lembut dan aromaterapi.',
            'price' => 160000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1556228724-4d3c6b66e3c7',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Aromatherapy Massage',
            'description' => 'Pijat menggunakan minyak aromaterapi untuk relaksasi maksimal.',
            'price' => 165000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1505577058444-a3dab90d4253',
            'is_additional' => 0,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Sport Massage',
            'description' => 'Pijat khusus untuk pemulihan otot setelah aktivitas olahraga.',
            'price' => 175000,
            'duration' => 90,
            'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881',
            'is_additional' => 0,
            'is_active' => 1
        ]);



        /* ========================
           LAYANAN TAMBAHAN (6)
        ======================== */

        Service::create([
            'name' => 'Aromatherapy Oil',
            'description' => 'Minyak aromaterapi untuk meningkatkan relaksasi selama pijat.',
            'price' => 25000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1505577058444-a3dab90d4253',
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Hot Stone Add-on',
            'description' => 'Tambahan terapi batu panas pada layanan pijat.',
            'price' => 30000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1600334129128-685c5582fd35',
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Body Scrub',
            'description' => 'Scrub tubuh untuk mengangkat sel kulit mati.',
            'price' => 35000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1200&auto=format',
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Foot Spa',
            'description' => 'Perawatan kaki untuk relaksasi dan kesehatan kaki.',
            'price' => 30000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07e',
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Herbal Compress',
            'description' => 'Kompres herbal hangat untuk membantu relaksasi otot.',
            'price' => 35000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
            'is_additional' => 1,
            'is_active' => 1
        ]);

        Service::create([
            'name' => 'Face Massage',
            'description' => 'Pijat wajah untuk meningkatkan sirkulasi darah dan relaksasi.',
            'price' => 30000,
            'duration' => 0,
            'image' => 'https://images.unsplash.com/photo-1598970434795-0c54fe7c0648',
            'is_additional' => 1,
            'is_active' => 1
        ]);

    }
}