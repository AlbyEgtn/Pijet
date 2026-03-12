@extends('layouts.customer')

@section('content')

<div class="bg-gradient-to-r from-teal-700 to-teal-600 text-white p-6">

    <h1 class="text-lg font-semibold">
        Riwayat Pesanan
    </h1>

</div>



<div class="max-w-5xl mx-auto p-6 space-y-4">

@forelse($orders as $order)

<div class="bg-white rounded-xl shadow p-5">

    <div class="flex justify-between items-center mb-4">

        <div>

            <p class="font-semibold">
                {{ $order->transaction_code }}
            </p>

            <p class="text-xs text-gray-500">
                {{ $order->created_at->format('d M Y H:i') }}
            </p>

        </div>

        <span class="text-xs px-3 py-1 rounded
            @if($order->status == 'belum_lunas') bg-yellow-100 text-yellow-700
            @elseif($order->status == 'lunas') bg-green-100 text-green-700
            @elseif($order->status == 'dibatalkan') bg-red-100 text-red-700
            @else bg-gray-100 text-gray-600
            @endif
        ">
            {{ ucfirst(str_replace('_',' ',$order->status)) }}
        </span>

    </div>


    <div class="space-y-2">

        @foreach($order->services as $service)

        <div class="flex justify-between text-sm">

            <span>
                {{ $service->service_name }}
            </span>

            <span class="text-gray-500">
                {{ $service->duration }} menit
            </span>

        </div>

        @endforeach

    </div>


    <div class="flex justify-between items-center mt-4 pt-3 border-t">

        <span class="text-sm text-gray-500">
            Metode: {{ ucfirst($order->payment_method) }}
        </span>

        <span class="font-semibold text-teal-600">
            Rp {{ number_format($order->total_price) }}
        </span>

    </div>

</div>

@empty

<div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">

    Belum ada pesanan.

</div>

@endforelse

</div>

@endsection