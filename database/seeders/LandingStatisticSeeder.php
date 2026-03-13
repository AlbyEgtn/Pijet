<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingStatistic;

class LandingStatisticSeeder extends Seeder
{

    public function run(): void
    {

        LandingStatistic::insert([

            [
                'title' => 'Customer',
                'value' => '200+'
            ],

            [
                'title' => 'Terapis',
                'value' => '82'
            ],

            [
                'title' => 'Layanan',
                'value' => '6'
            ],

            [
                'title' => 'Kepuasan',
                'value' => '95%'
            ]

        ]);

    }

}