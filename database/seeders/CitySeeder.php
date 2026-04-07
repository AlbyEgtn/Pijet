<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [

            // SUMATERA
            ['name' => 'Kabupaten Aceh Besar'],
            ['name' => 'Kabupaten Aceh Barat'],
            ['name' => 'Kabupaten Aceh Utara'],
            ['name' => 'Kabupaten Pidie'],
            ['name' => 'Kabupaten Bireuen'],
            ['name' => 'Kabupaten Deli Serdang'],
            ['name' => 'Kabupaten Langkat'],
            ['name' => 'Kabupaten Asahan'],
            ['name' => 'Kabupaten Simalungun'],
            ['name' => 'Kabupaten Labuhanbatu'],
            ['name' => 'Kabupaten Kampar'],
            ['name' => 'Kabupaten Siak'],
            ['name' => 'Kabupaten Bengkalis'],
            ['name' => 'Kabupaten Indragiri Hilir'],
            ['name' => 'Kabupaten Indragiri Hulu'],
            ['name' => 'Kabupaten Batanghari'],
            ['name' => 'Kabupaten Muaro Jambi'],
            ['name' => 'Kabupaten Kerinci'],
            ['name' => 'Kabupaten Rejang Lebong'],
            ['name' => 'Kabupaten Bengkulu Utara'],

            // SUMBAR
            ['name' => 'Kabupaten Agam'],
            ['name' => 'Kabupaten Tanah Datar'],
            ['name' => 'Kabupaten Lima Puluh Kota'],
            ['name' => 'Kabupaten Pasaman'],
            ['name' => 'Kabupaten Solok'],

            // SUMSEL
            ['name' => 'Kabupaten Ogan Komering Ilir'],
            ['name' => 'Kabupaten Ogan Ilir'],
            ['name' => 'Kabupaten Muara Enim'],
            ['name' => 'Kabupaten Lahat'],
            ['name' => 'Kabupaten Musi Banyuasin'],

            // JAWA BARAT
            ['name' => 'Kabupaten Bandung'],
            ['name' => 'Kabupaten Bandung Barat'],
            ['name' => 'Kabupaten Bekasi'],
            ['name' => 'Kabupaten Bogor'],
            ['name' => 'Kabupaten Cianjur'],
            ['name' => 'Kabupaten Cirebon'],
            ['name' => 'Kabupaten Garut'],
            ['name' => 'Kabupaten Indramayu'],
            ['name' => 'Kabupaten Karawang'],
            ['name' => 'Kabupaten Kuningan'],

            // JAWA TENGAH
            ['name' => 'Kabupaten Banyumas'],
            ['name' => 'Kabupaten Cilacap'],
            ['name' => 'Kabupaten Kebumen'],
            ['name' => 'Kabupaten Magelang'],
            ['name' => 'Kabupaten Pati'],
            ['name' => 'Kabupaten Kudus'],
            ['name' => 'Kabupaten Jepara'],
            ['name' => 'Kabupaten Brebes'],
            ['name' => 'Kabupaten Tegal'],
            ['name' => 'Kabupaten Grobogan'],

            // JAWA TIMUR
            ['name' => 'Kabupaten Banyuwangi'],
            ['name' => 'Kabupaten Jember'],
            ['name' => 'Kabupaten Malang'],
            ['name' => 'Kabupaten Pasuruan'],
            ['name' => 'Kabupaten Sidoarjo'],
            ['name' => 'Kabupaten Gresik'],
            ['name' => 'Kabupaten Lamongan'],
            ['name' => 'Kabupaten Bojonegoro'],
            ['name' => 'Kabupaten Tuban'],
            ['name' => 'Kabupaten Mojokerto'],

            // BALI & NUSA TENGGARA
            ['name' => 'Kabupaten Badung'],
            ['name' => 'Kabupaten Gianyar'],
            ['name' => 'Kabupaten Tabanan'],
            ['name' => 'Kabupaten Buleleng'],
            ['name' => 'Kabupaten Lombok Barat'],
            ['name' => 'Kabupaten Lombok Tengah'],
            ['name' => 'Kabupaten Lombok Timur'],
            ['name' => 'Kabupaten Sumbawa'],
            ['name' => 'Kabupaten Dompu'],
            ['name' => 'Kabupaten Manggarai'],

            // KALIMANTAN
            ['name' => 'Kabupaten Kubu Raya'],
            ['name' => 'Kabupaten Mempawah'],
            ['name' => 'Kabupaten Ketapang'],
            ['name' => 'Kabupaten Sambas'],
            ['name' => 'Kabupaten Berau'],
            ['name' => 'Kabupaten Kutai Kartanegara'],
            ['name' => 'Kabupaten Kutai Timur'],
            ['name' => 'Kabupaten Penajam Paser Utara'],
            ['name' => 'Kabupaten Banjar'],
            ['name' => 'Kabupaten Tanah Laut'],

            // SULAWESI
            ['name' => 'Kabupaten Gowa'],
            ['name' => 'Kabupaten Maros'],
            ['name' => 'Kabupaten Bone'],
            ['name' => 'Kabupaten Wajo'],
            ['name' => 'Kabupaten Pinrang'],
            ['name' => 'Kabupaten Konawe'],
            ['name' => 'Kabupaten Kolaka'],
            ['name' => 'Kabupaten Muna'],
            ['name' => 'Kabupaten Minahasa'],
            ['name' => 'Kabupaten Bolaang Mongondow'],

            // PAPUA & MALUKU
            ['name' => 'Kabupaten Jayapura'],
            ['name' => 'Kabupaten Merauke'],
            ['name' => 'Kabupaten Mimika'],
            ['name' => 'Kabupaten Nabire'],
            ['name' => 'Kabupaten Biak Numfor'],
            ['name' => 'Kabupaten Seram Bagian Barat'],
            ['name' => 'Kabupaten Maluku Tengah'],
            ['name' => 'Kabupaten Buru'],
            ['name' => 'Kabupaten Halmahera Barat'],
            ['name' => 'Kabupaten Halmahera Selatan'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}