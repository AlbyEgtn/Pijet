@extends('layouts.finance')

@section('title','Dashboard')
@section('header','Dashboard Finance')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-semibold">
            Dashboard Keuangan
        </h2>

        <p class="text-sm text-teal-100">
            Monitoring pemasukan, pengeluaran, dan performa bisnis
        </p>

    </div>


    <!-- STATISTIC -->
    <div class="grid grid-cols-2 gap-6">

        <!-- INCOME -->
        <div class="bg-white rounded-2xl p-5 shadow flex justify-between items-center">

            <div>
                <p class="text-sm text-gray-500">Total Pemasukan</p>
                <h2 class="text-2xl font-bold text-teal-700">
                    Rp {{ number_format($grossIncome) }}
                </h2>
            </div>

            <div class="bg-teal-100 text-teal-700 p-3 rounded-lg">
                ⬇
            </div>

        </div>


        <!-- EXPENSE -->
        <div class="bg-white rounded-2xl p-5 shadow flex justify-between items-center">

            <div>
                <p class="text-sm text-gray-500">Total Pengeluaran (70%)</p>
                <h2 class="text-2xl font-bold text-red-500">
                    Rp {{ number_format($totalExpense,0,',','.') }}
                </h2>
            </div>

            <div class="bg-red-100 text-red-500 p-3 rounded-lg">
                ⬆
            </div>

        </div>


        <!-- PROFIT -->
        <div class="bg-white rounded-2xl p-5 shadow flex justify-between items-center">

            <div>
                <p class="text-sm text-gray-500">Keuntungan Perusahaan (30%)</p>
                <h2 class="text-2xl font-bold text-teal-700">
                    Rp {{ number_format($companyIncome,0,',','.') }}
                </h2>
            </div>

            <div class="bg-teal-100 text-teal-700 p-3 rounded-lg">
                📈
            </div>

        </div>


        <!-- BALANCE -->
        <div class="bg-white rounded-2xl p-5 shadow flex justify-between items-center">

            <div>
                <p class="text-sm text-gray-500">Saldo Perusahaan</p>
                <h2 class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format($balance,0,',','.') }}
                </h2>
            </div>

            <div class="bg-gray-100 p-3 rounded-lg">
                💰
            </div>

        </div>

    </div>


    <!-- CHART REKAP -->
    <div class="bg-white rounded-2xl p-6 shadow">

        <div class="flex justify-between mb-4">

            <h3 class="font-semibold text-gray-700">
                Rekap Bulanan
            </h3>

            <span class="text-sm text-gray-400">
                {{ date('Y') }}
            </span>

        </div>

        <canvas id="rekapChart" height="100"></canvas>

    </div>


    <!-- BOTTOM -->
    <div class="grid grid-cols-2 gap-6">

        <!-- PIE -->
        <div class="bg-white rounded-2xl p-6 shadow">

            <h3 class="font-semibold mb-4 text-gray-700">
                Layanan Terpopuler
            </h3>

            <canvas id="serviceChart"></canvas>

        </div>


        <!-- LINE -->
        <div class="bg-white rounded-2xl p-6 shadow">

            <h3 class="font-semibold mb-4 text-gray-700">
                Status Pesanan
            </h3>

            <canvas id="orderChart"></canvas>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ================= REKAP =================
    const rekapCtx = document.getElementById('rekapChart');

    if (rekapCtx) {
        new Chart(rekapCtx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [
                    {
                        label: 'Jumlah Booking',
                        data: @json($ordersChart),
                        backgroundColor: '#0F766E'
                    },
                    {
                        type: 'line',
                        label: 'Pemasukan',
                        data: @json($incomeChart),
                        borderColor: '#14B8A6',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    }


    // ================= PIE =================
    const serviceCtx = document.getElementById('serviceChart');

    if (serviceCtx) {
        new Chart(serviceCtx, {
            type: 'pie',
            data: {
                labels: @json($serviceLabels),
                datasets: [
                    {
                        data: @json($serviceData),
                        backgroundColor: [
                            '#0F766E','#14B8A6','#5EEAD4','#99F6E4','#CCFBF1','#ECFEFF'
                        ]
                    }
                ]
            }
        });
    }


    // ================= ORDER =================
    const orderCtx = document.getElementById('orderChart');

    if (orderCtx) {
        new Chart(orderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed','Cancelled'],
                datasets: [
                    {
                        data: [{{ $completed }}, {{ $cancelled }}],
                        backgroundColor: ['#0F766E','#EF4444']
                    }
                ]
            }
        });
    }

});

</script>

@endsection