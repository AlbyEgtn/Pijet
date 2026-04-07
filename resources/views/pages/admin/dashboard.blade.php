@extends('layouts.admin')

@section('title','Dashboard Admin')
@section('header','Dashboard Admin')

@section('content')

<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow flex justify-between items-center">

        <div>
            <h2 class="text-xl font-semibold">
                Dashboard Admin 👋
            </h2>
            <p class="text-sm text-teal-100">
                Monitoring sistem & performa layanan
            </p>
        </div>

    </div>


    <!-- ================= RINGKASAN ================= -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white rounded-2xl p-6 shadow">

        <h2 class="font-semibold mb-6 text-lg">
            Ringkasan Statistik
        </h2>

        <div class="grid grid-cols-4 gap-4">

            <div class="bg-white/10 backdrop-blur rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-teal-100">Total Customer</p>
                    <h2 class="text-2xl font-bold mt-1">{{ $totalCustomers }}</h2>
                </div>
                <div class="text-3xl">👤</div>
            </div>

            <div class="bg-white/10 backdrop-blur rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-teal-100">Total Terapis</p>
                    <h2 class="text-2xl font-bold mt-1">{{ $totalTherapists }}</h2>
                </div>
                <div class="text-3xl">👨‍⚕️</div>
            </div>

            <div class="bg-white/10 backdrop-blur rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-teal-100">Pesanan Selesai</p>
                    <h2 class="text-2xl font-bold mt-1">{{ $totalCompletedOrders }}</h2>
                </div>
                <div class="text-3xl text-green-300">✔</div>
            </div>

            <div class="bg-white/10 backdrop-blur rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-teal-100">Pesanan Batal</p>
                    <h2 class="text-2xl font-bold mt-1">{{ $totalCancelledOrders }}</h2>
                </div>
                <div class="text-3xl text-red-300">✖</div>
            </div>

        </div>

    </div>


    <!-- ================= CHART + LAYANAN ================= -->
    <div class="grid grid-cols-3 gap-6">

        <!-- CHART -->
        <div class="col-span-2 bg-white rounded-2xl p-6 shadow">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-700">
                    Chart Pemesanan Tahunan
                </h3>
            </div>

            <canvas id="orderChart" class="h-56"></canvas>

        </div>


        <!-- LAYANAN -->
        <div class="bg-white rounded-2xl p-6 shadow">

            <h3 class="font-semibold text-gray-700 mb-4">
                Layanan Terpopuler
            </h3>

            <div class="space-y-3">

                @foreach($popularServices as $index => $service)

                <div class="flex justify-between items-center p-3 rounded-lg bg-gray-50">

                    <span class="text-gray-700">
                        {{ $service->name }}
                    </span>

                    <span class="text-sm font-semibold px-3 py-1 rounded-full
                        @if($index == 0) bg-yellow-100 text-yellow-600
                        @elseif($index == 1) bg-gray-200 text-gray-600
                        @else bg-red-100 text-red-500
                        @endif
                    ">
                        #{{ $index + 1 }}
                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>


    <!-- ================= TABLE ================= -->
    <div class="grid grid-cols-2 gap-6">

        <!-- PESANAN -->
        <div class="bg-white rounded-2xl p-6 shadow">

            <h3 class="font-semibold text-gray-700 mb-4">
                Pesanan Terbaru
            </h3>

            <table class="w-full text-sm">

                <thead class="text-gray-400 text-xs uppercase">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($latestOrders as $order)

                    <tr class="hover:bg-gray-50 transition">

                        <td>{{ $order->transaction_code }}</td>
                        <td>{{ $order->service_date }}</td>
                        <td>{{ $order->customer_name }}</td>

                        <td>
                            @if($order->order_status == 'completed')
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Selesai</span>

                            @elseif($order->order_status == 'cancelled')
                                <span class="bg-red-100 text-red-500 px-2 py-1 rounded-full text-xs">Batal</span>

                            @elseif($order->order_status == 'process')
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs">Proses</span>

                            @else
                                <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs">
                                    {{ $order->order_status }}
                                </span>
                            @endif
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <!-- TERAPIS -->
        <div class="bg-white rounded-2xl p-6 shadow">

            <h3 class="font-semibold text-gray-700 mb-4">
                Terapis Terbaru
            </h3>

            <table class="w-full text-sm">

                <thead class="text-gray-400 text-xs uppercase">
                    <tr>
                        <th class="pb-3 text-left">Nama</th>
                        <th class="pb-3 text-left">Email</th>
                        <th class="pb-3 text-left">Kontak</th>
                        <th class="pb-3 text-left">Kota</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($latestTherapists as $therapist)

                    @php
                        $city = json_decode($therapist->city, true);
                    @endphp

                    <tr class="hover:bg-gray-50 transition">

                        <!-- NAMA -->
                        <td class="py-3 font-medium text-gray-700">
                            {{ $therapist->name }}
                        </td>

                        <!-- EMAIL -->
                        <td class="py-3 text-gray-600 max-w-[180px] truncate">
                            {{ $therapist->email }}
                        </td>

                        <!-- KONTAK -->
                        <td class="py-3 text-gray-600">
                            {{ $therapist->phone }}
                        </td>

                        <!-- KOTA -->
                        <td class="py-3">
                            <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs">
                                {{ $city['name'] ?? '-' }}
                            </span>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection



@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('orderChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ],

        datasets: [
            {
                label: 'Jumlah Pesanan',
                data: @json($chartData),
                borderColor: '#0F766E',
                backgroundColor: 'rgba(15,118,110,0.15)',
                tension: 0.4,
                fill: true
            }
        ]

    },

    options: {

        responsive: true,

        plugins: {
            legend: { display: false }
        },

        scales: {
            y: { beginAtZero: true }
        }

    }

});

</script>

@endsection