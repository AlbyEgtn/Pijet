@extends('layouts.customer')

@section('content')

<!-- ================= HEADER ================= -->
<div class="bg-gradient-to-r from-teal-700 to-teal-600 text-white p-6">
    <h1 class="text-lg font-semibold">
        Riwayat Pesanan
    </h1>
</div>


<!-- ================= STATUS MENU ================= -->
<div class="max-w-5xl mx-auto px-6 pt-6">

    <div class="flex gap-3 overflow-x-auto pb-2">

        <!-- BELUM BAYAR -->
        <a href="{{ route('customer.orders',['status'=>'belum_lunas']) }}"
            class="px-4 py-2 rounded-full text-sm whitespace-nowrap
            {{ $status == 'belum_lunas'
                ? 'bg-teal-600 text-white'
                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
            }}">
            Belum Bayar
        </a>

        <!-- SELESAI -->
        <a href="{{ route('customer.orders',['status'=>'lunas']) }}"
            class="px-4 py-2 rounded-full text-sm whitespace-nowrap
            {{ $status == 'lunas'
                ? 'bg-teal-600 text-white'
                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
            }}">
            Selesai
        </a>

        <!-- RESCHEDULE -->
        <a href="{{ route('customer.orders',['status'=>'reschedule']) }}"
            class="px-4 py-2 rounded-full text-sm whitespace-nowrap
            {{ $status == 'reschedule'
                ? 'bg-teal-600 text-white'
                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
            }}">
            Reschedule
        </a>

        <!-- DIBATALKAN -->
        <a href="{{ route('customer.orders',['status'=>'dibatalkan']) }}"
            class="px-4 py-2 rounded-full text-sm whitespace-nowrap
            {{ $status == 'dibatalkan'
                ? 'bg-teal-600 text-white'
                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
            }}">
            Dibatalkan
        </a>

    </div>

</div>


<!-- ================= ORDER LIST ================= -->
<div class="max-w-5xl mx-auto p-6 space-y-4">

@forelse($orders as $order)

@php
    // 🔥 STATUS LOGIC (SINGLE SOURCE OF TRUTH)
    if(in_array($order->payment_status, ['pending','uploaded'])){
        $label = 'Belum Bayar';
        $color = 'bg-yellow-100 text-yellow-700';
    }
    elseif($order->order_status == 'process'){
        $label = 'Proses';
        $color = 'bg-blue-100 text-blue-700';
    }
    elseif($order->payment_status == 'verified'){
        $label = 'Selesai';
        $color = 'bg-green-100 text-green-700';
    }
    elseif($order->order_status == 'reschedule'){
        $label = 'Reschedule';
        $color = 'bg-purple-100 text-purple-700';
    }
    elseif($order->order_status == 'cancelled'){
        $label = 'Dibatalkan';
        $color = 'bg-red-100 text-red-700';
    }
    else{
        $label = 'Unknown';
        $color = 'bg-gray-100 text-gray-600';
    }
@endphp

<div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition p-5">

    <!-- ORDER HEADER -->
    <div class="flex justify-between items-start mb-4">

        <div>
            <p class="font-semibold text-gray-800">
                {{ $order->transaction_code }}
            </p>

            <p class="text-xs text-gray-500 mt-1">
                {{ $order->created_at->format('d M Y H:i') }}
            </p>
        </div>

        <!-- STATUS BADGE -->
        <span class="text-xs px-3 py-1 rounded-full font-medium {{ $color }}">
            {{ $label }}
        </span>

    </div>


    <!-- SERVICES -->
    <div class="space-y-2">

        @foreach($order->services as $service)

        <div class="flex justify-between text-sm">

            <span class="text-gray-700">
                {{ $service->service_name }}
            </span>

            <span class="text-gray-500">
                {{ $service->duration }} menit
            </span>

        </div>

        @endforeach

    </div>


    <!-- FOOTER -->
    <div class="flex justify-between items-center mt-4 pt-3 border-t">

        <span class="text-sm text-gray-500">
            Metode: {{ ucfirst($order->payment_method) }}
        </span>

        <div class="flex items-center gap-4">

            <span class="font-semibold text-teal-600">
                Rp {{ number_format($order->total_price) }}
            </span>

            <a href="{{ route('customer.orders.show',$order->id) }}"
                class="text-sm bg-teal-600 hover:bg-teal-700 text-white px-4 py-1.5 rounded-lg transition">
                Detail
            </a>

        </div>

    </div>

</div>

@empty

<div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">

    <p class="text-sm">
        Belum ada pesanan pada kategori ini.
    </p>

</div>

@endforelse

</div>

@endsection