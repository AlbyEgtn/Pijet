@extends('layouts.finance')

@section('title','Dashboard')
@section('header','Dashboard')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center mb-6">

        <a
            href="{{ route('finance.dashboard.overview') }}"
            class="bg-teal-500 text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition"
        >
            Overview
        </a>

    </div>

    <!-- STATISTIC CARDS -->
    <div class="grid grid-cols-3 gap-6">

        <!-- TRANSAKSI MASUK -->
        <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">Total transaksi masuk</p>
                <h2 class="text-2xl font-semibold">Rp.14.500.000</h2>
                <p class="text-xs text-green-500">Unit order</p>
            </div>

            <div class="bg-gray-100 p-3 rounded-lg">
                ➜
            </div>

        </div>


        <!-- TRANSAKSI KELUAR -->
        <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">Total transaksi keluar</p>
                <h2 class="text-2xl font-semibold">Rp.7.800.000</h2>
                <p class="text-xs text-blue-500">Unit order</p>
            </div>

            <div class="bg-gray-100 p-3 rounded-lg">
                ➜
            </div>

        </div>


        <!-- SALDO -->
        <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">Total saldo perusahaan</p>
                <h2 class="text-2xl font-semibold">Rp.50.000.000</h2>
            </div>

            <div class="bg-gray-100 p-3 rounded-lg">
                💰
            </div>

        </div>

    </div>


    <!-- REKAP CHART -->
    <div class="bg-white rounded-xl p-6 shadow-sm">

        <div class="flex justify-between mb-4">

            <h3 class="font-semibold">Rekap</h3>

            <span class="text-sm text-gray-400">
                2023
            </span>

        </div>

        <canvas id="rekapChart" height="100"></canvas>

    </div>


    <!-- BOTTOM CHART -->
    <div class="grid grid-cols-2 gap-6">

        <!-- PIE -->
        <div class="bg-white rounded-xl p-6 shadow-sm">

            <h3 class="font-semibold mb-4">
                Layanan Terpopuler
            </h3>

            <canvas id="serviceChart"></canvas>

        </div>


        <!-- LINE -->
        <div class="bg-white rounded-xl p-6 shadow-sm">

            <h3 class="font-semibold mb-4">
                Riwayat Pesanan
            </h3>

            <canvas id="orderChart"></canvas>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const rekapCtx = document.getElementById('rekapChart');

new Chart(rekapCtx, {

    type: 'bar',

    data: {

        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

        datasets: [

            {
                label: 'Jumlah booking perbulan',
                data: [60,80,70,50,90,75,40,55,85,72,60,95],
                backgroundColor: '#2FB5B2'
            },

            {
                type: 'line',
                label: 'Jumlah pemasukan perbulan',
                data: [20,40,35,25,45,38,15,28,40,30,35,48],
                borderColor: '#1E9AA7',
                tension: 0.4
            }

        ]

    },

    options: {

        responsive: true,
        plugins: { legend: { position: 'top' } }

    }

});


const serviceCtx = document.getElementById('serviceChart');

new Chart(serviceCtx, {

    type: 'pie',

    data: {

        labels: [
            'Full Body',
            'Traditional',
            'Deep Tissue',
            'Thai Massage',
            'Hot Stone',
            'Swedish Massage'
        ],

        datasets: [

            {

                data: [40,27,18,10,4,1],

                backgroundColor: [
                    '#2FB5B2',
                    '#4ED0C6',
                    '#8BE3C5',
                    '#B6F0D9',
                    '#D6F7EB',
                    '#EAFDF6'
                ]

            }

        ]

    }

});


const orderCtx = document.getElementById('orderChart');

new Chart(orderCtx, {

    type: 'line',

    data: {

        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

        datasets: [

            {
                label: 'Pesanan selesai',
                data: [120,140,160,210,180,150,140,130,160,170,155,145],
                borderColor: 'green',
                tension: 0.4
            },

            {
                label: 'Pesanan dibatalkan',
                data: [40,60,55,70,45,60,62,58,80,50,48,52],
                borderColor: 'red',
                tension: 0.4
            }

        ]

    }

});

</script>

@endsection