@extends('layouts.finance')

@section('title','Dashboard Overview')
@section('header','Dashboard')

@section('content')

<div class="space-y-6">

    <!-- HEADER + SWITCH -->
    <div class="flex justify-between items-center">

        <a
            href="{{ route('finance.dashboard') }}"
            class="bg-gray-200 px-4 py-2 rounded-lg text-sm hover:bg-gray-300"
        >
            Dashboard Utama
        </a>

    </div>


    <!-- OVERVIEW CARD -->
    <div class="border-2 border-blue-500 rounded-xl p-6">

        <h3 class="text-sm font-semibold mb-4">
            Over View
        </h3>

        <div class="grid grid-cols-3 gap-6">

            <!-- PENDAPATAN -->
            <div class="flex items-center gap-4 border rounded-xl p-4">

                <div class="bg-teal-500 text-white p-3 rounded-lg">
                    💰
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Pendapat Harian
                    </p>

                    <h3 class="text-xl font-semibold">
                        Rp14.500
                    </h3>

                    <p class="text-xs text-teal-600">
                        Lihat detail
                    </p>
                </div>

            </div>


            <!-- TRANSAKSI MASUK -->
            <div class="flex items-center gap-4 border rounded-xl p-4">

                <div class="bg-teal-500 text-white p-3 rounded-lg">
                    🪙
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Total Transaksi Masuk
                    </p>

                    <h3 class="text-xl font-semibold">
                        Rp14.500
                    </h3>

                    <p class="text-xs text-teal-600">
                        Lihat detail
                    </p>
                </div>

            </div>


            <!-- TRANSAKSI KELUAR -->
            <div class="flex items-center gap-4 border rounded-xl p-4">

                <div class="bg-teal-500 text-white p-3 rounded-lg">
                    💸
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Total Transaksi Keluar
                    </p>

                    <h3 class="text-xl font-semibold">
                        Rp14.500
                    </h3>

                    <p class="text-xs text-teal-600">
                        Lihat detail
                    </p>
                </div>

            </div>

        </div>

    </div>


    <!-- CHART -->
    <div class="grid grid-cols-4 gap-6">

        <!-- CHART AREA -->
        <div class="col-span-3 bg-white rounded-xl p-6 shadow-sm">

            <canvas id="overviewChart"></canvas>

        </div>


        <!-- LEGEND -->
        <div class="space-y-4">

            <div class="bg-white p-4 rounded-xl shadow-sm">

                <div class="flex items-center gap-3">

                    <span class="w-4 h-4 bg-yellow-400 rounded-full"></span>

                    <span class="text-sm">
                        Jumlah booking perbulan
                    </span>

                </div>

            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">

                <div class="flex items-center gap-3">

                    <span class="w-4 h-4 bg-blue-500 rounded-full"></span>

                    <span class="text-sm">
                        Jumlah pemasukan perbulan
                    </span>

                </div>

            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">

                <div class="flex items-center gap-3">

                    <span class="w-4 h-4 bg-red-500 rounded-full"></span>

                    <span class="text-sm">
                        Jumlah pembatalan perbulan
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- BOTTOM CHART -->
    <div class="grid grid-cols-2 gap-6">

        <!-- PIE -->
        <div class="bg-white rounded-xl p-6 shadow-sm">

            <div class="flex justify-between mb-4">

                <h3 class="font-semibold">
                    Layanan Terpopuler
                </h3>

                <span class="text-sm text-gray-400">
                    2023
                </span>

            </div>

            <canvas id="serviceChart"></canvas>

        </div>


        <!-- LINE -->
        <div class="bg-white rounded-xl p-6 shadow-sm">

            <div class="flex justify-between mb-4">

                <h3 class="font-semibold">
                    Riwayat Pesanan
                </h3>

                <span class="text-sm text-gray-400">
                    2023
                </span>

            </div>

            <canvas id="orderChart"></canvas>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('overviewChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

        datasets: [

            {
                label: 'Booking',
                data: [30,60,35,40,38,90,55,32,58,65,70,50],
                borderColor: '#facc15',
                tension: 0.4
            },

            {
                label: 'Pemasukan',
                data: [25,50,30,35,32,85,50,28,52,60,65,48],
                borderColor: '#3b82f6',
                tension: 0.4
            },

            {
                label: 'Pembatalan',
                data: [10,40,20,15,30,25,18,15,35,28,20,18],
                borderColor: '#ef4444',
                tension: 0.4
            }

        ]

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
                    '#4ade80',
                    '#86efac',
                    '#bbf7d0',
                    '#dcfce7',
                    '#f0fdf4',
                    '#ecfdf5'
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
                data: [150,160,180,220,170,150,140,135,145,160,170,140],
                borderColor: 'green',
                tension: 0.4
            },

            {
                label: 'Pesanan dibatalkan',
                data: [80,120,110,100,130,90,85,95,105,130,115,100],
                borderColor: 'red',
                tension: 0.4
            }

        ]

    }

});

</script>

@endsection