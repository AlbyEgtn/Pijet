<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::insert([

            [
                'kode_cabang' => 'CBG001',
                'kota' => 'Bandar Lampung',
                'provinsi' => 'Lampung',
                'tanggal_peresmian' => '2022-05-10',
                'detail_lokasi' => 'Jl. ZA Pagar Alam No. 45, Rajabasa',
                'email' => 'lampung@pijat.in',
                'deskripsi' => 'Cabang utama Pijat.in di Bandar Lampung dengan layanan refleksi lengkap.',
                'status' => 'Aktif'
            ],

            [
                'kode_cabang' => 'CBG002',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'tanggal_peresmian' => '2023-01-15',
                'detail_lokasi' => 'Jl. Sudirman No. 12, Jakarta Pusat',
                'email' => 'jakarta@pijat.in',
                'deskripsi' => 'Cabang Jakarta dengan fasilitas premium dan terapis profesional.',
                'status' => 'Aktif'
            ],

            [
                'kode_cabang' => 'CBG003',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'tanggal_peresmian' => '2023-07-20',
                'detail_lokasi' => 'Jl. Dago No. 88, Bandung',
                'email' => 'bandung@pijat.in',
                'deskripsi' => 'Cabang Bandung dengan konsep relaksasi modern.',
                'status' => 'Aktif'
            ],

            [
                'kode_cabang' => 'CBG004',
                'kota' => 'Yogyakarta',
                'provinsi' => 'DI Yogyakarta',
                'tanggal_peresmian' => '2024-02-10',
                'detail_lokasi' => 'Jl. Malioboro No. 20',
                'email' => 'jogja@pijat.in',
                'deskripsi' => 'Cabang Yogyakarta yang fokus pada terapi tradisional.',
                'status' => 'Aktif'
            ]

        ]);
    }
}