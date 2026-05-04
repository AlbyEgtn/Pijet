@extends('layouts.superadmin')

@section('title','Dashboard')
@section('header','Dashboard')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-semibold tracking-wide">
            Dashboard Super Admin
        </h2>
        <p class="text-sm opacity-90">
            Monitoring performa sistem & transaksi secara real-time
        </p>
    </div>

    <!-- SUMMARY -->
    <div class="grid grid-cols-3 gap-6">

        <!-- USER -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total User</p>
            <h2 class="text-3xl font-bold mt-2 counter" data-target="{{ $totalUser }}">0</h2>
        </div>

        <!-- TRANSAKSI -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <h2 class="text-3xl font-bold mt-2 counter" data-target="{{ $totalTransaction }}">0</h2>
        </div>

        <!-- REVENUE -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <h2 class="text-3xl font-bold mt-2 text-green-600">
                Rp {{ number_format($totalRevenue,0,',','.') }}
            </h2>
        </div>

    </div>

    <!-- CHART + INSIGHT -->
    <div class="grid grid-cols-3 gap-6">

        <!-- CHART -->
        <div class="col-span-2 bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-gray-700 mb-4">
                Revenue (6 Bulan Terakhir)
            </h3>
            <canvas id="chart"></canvas>
        </div>

        <!-- SIDE INSIGHT -->
        <div class="bg-white p-6 rounded-2xl shadow space-y-4">

            <div>
                <p class="text-gray-500 text-sm">Transaksi Hari Ini</p>
                <p class="text-xl font-bold">
                    {{ \App\Models\Transaction::whereDate('created_at', now())->count() }}
                </p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">User Baru</p>
                <p class="text-xl font-bold">
                    {{ \App\Models\User::whereDate('created_at', now())->count() }}
                </p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Pending</p>
                <p class="text-xl font-bold text-yellow-600">
                    {{ \App\Models\Transaction::where('order_status','pending')->count() }}
                </p>
            </div>

        </div>

    </div>

    <!-- RECENT -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="font-semibold text-gray-700 mb-4">
            Transaksi Terbaru
        </h3>

        @foreach($recentTransactions as $trx)
        <div class="flex justify-between items-center py-3 border-b">

            <div class="text-sm">
                <p class="font-medium">#{{ $trx->id }}</p>
                <p class="text-gray-400 text-xs">
                    {{ $trx->created_at->format('d M Y') }}
                </p>
            </div>

            <span class="px-3 py-1 rounded-full text-xs
                @if($trx->order_status == 'completed') bg-green-100 text-green-700
                @elseif($trx->order_status == 'pending') bg-yellow-100 text-yellow-700
                @else bg-red-100 text-red-700
                @endif">
                {{ $trx->order_status }}
            </span>

            <div class="font-semibold text-teal-600">
                Rp {{ number_format($trx->total_price,0,',','.') }}
            </div>

        </div>
        @endforeach

    </div>

</div>


<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// COUNTER ANIMATION
document.querySelectorAll('.counter').forEach(counter => {
    let update = () => {
        let target = +counter.getAttribute('data-target');
        let count = +counter.innerText;
        let inc = target / 40;

        if(count < target){
            counter.innerText = Math.ceil(count + inc);
            setTimeout(update, 20);
        } else {
            counter.innerText = target;
        }
    };
    update();
});

// CHART (REAL DATA)
new Chart(document.getElementById('chart'), {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Revenue',
            data: @json($revenues),
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                ticks: {
                    callback: value => 'Rp ' + value.toLocaleString()
                }
            }
        }
    }
});
</script>

@endsection