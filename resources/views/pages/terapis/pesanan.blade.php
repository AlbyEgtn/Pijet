@extends('layouts.terapis')

@section('title','Pesanan')
@section('header','Pesanan')

@section('content')

<div class="p-6 max-w-5xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Pesanan Tersedia
            </h1>
            <p class="text-sm text-gray-500">
                Ambil pesanan sesuai lokasi kamu
            </p>
        </div>

        <div class="text-sm text-gray-500">
            {{ $transactions->total() ?? 0 }} Pesanan
        </div>

    </div>

    <!-- ALERT -->
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- LIST -->
    <div class="space-y-4">

        @forelse($transactions as $trx)

        <div class="bg-white border rounded-2xl p-5 shadow-sm hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <!-- LEFT -->
                <div class="flex gap-4">

                    <!-- AVATAR -->
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-700 text-white flex items-center justify-center rounded-full font-semibold">
                        {{ strtoupper(substr($trx->customer_name,0,1)) }}
                    </div>

                    <!-- INFO -->
                    <div class="space-y-1">

                        <p class="font-semibold text-gray-800">
                            {{ $trx->customer_name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ $trx->customer_city ?? '-' }}
                        </p>

                        <p class="text-sm text-gray-600">
                            {{ $trx->services->first()->service_name ?? '-' }}
                            • {{ $trx->services->first()->duration ?? 0 }} menit
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                            • {{ $trx->service_time }}
                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="text-right space-y-2">

                    <!-- PRICE -->
                    <p class="font-semibold text-teal-600">
                        Rp{{ number_format($trx->total_price,0,',','.') }}
                    </p>

                    <!-- STATUS -->
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($trx->order_status == 'ready') bg-yellow-100 text-yellow-700
                        @elseif($trx->order_status == 'assigned') bg-blue-100 text-blue-700
                        @elseif($trx->order_status == 'completed') bg-green-100 text-green-700
                        @elseif($trx->order_status == 'cancelled') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-600
                        @endif
                    ">
                        {{ ucfirst(str_replace('_',' ',$trx->order_status)) }}
                    </span>

                </div>

            </div>

            <!-- FOOTER ACTION -->
            <div class="mt-4 flex justify-between items-center">

                <a href="{{ route('terapis.pesanan.detail', $trx->id) }}"
                   class="text-sm text-teal-600 font-medium hover:underline">
                    Lihat Detail
                </a>

                <!-- BUTTON AMBIL -->
                @if($terapis->status == 1)

                    <form action="{{ route('terapis.pesanan.ambil', $trx->id) }}" method="POST">
                        @csrf
                        <button
                            class="bg-teal-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-teal-700">
                            Ambil
                        </button>
                    </form>

                @else

                    <button disabled
                        class="bg-gray-300 text-gray-500 text-sm px-4 py-2 rounded-lg cursor-not-allowed">
                        Offline
                    </button>

                @endif

            </div>

        </div>

        @empty

        <!-- EMPTY STATE -->
        <div class="text-center py-16">

            <div class="text-5xl text-gray-300 mb-3">
                📭
            </div>

            <p class="text-gray-500">
                Tidak ada pesanan tersedia
            </p>

        </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>

</div>

@endsection