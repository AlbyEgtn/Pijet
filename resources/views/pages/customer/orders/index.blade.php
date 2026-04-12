@extends('layouts.customer')

@section('title','Pesanan')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 h-full flex items-center text-white">

        <div>
            <h1 class="text-2xl font-semibold">
                Riwayat Pesanan
            </h1>
            <p class="text-sm opacity-90">
                Pantau status layanan Anda secara realtime
            </p>
        </div>

    </div>

</section>


<!-- ================= FILTER ================= -->
<div class="max-w-5xl mx-auto px-6 pt-6">

    <div class="flex gap-3 overflow-x-auto pb-2">

        @php
            $filters = [
                'all'           => 'Semua',
                'belum_lunas'   => 'Belum Bayar',
                'diproses'      => 'Diproses',
                'selesai'       => 'Selesai',
                'dibatalkan'    => 'Dibatalkan',
                'rescheduled'   => 'Reschedule'
            ];
        @endphp

        @foreach($filters as $key => $label)

        <a href="{{ route('customer.orders',['status'=>$key]) }}"
            class="px-4 py-2 rounded-full text-sm whitespace-nowrap transition-all duration-200
            {{ ($status ?? 'all') == $key
                ? 'bg-teal-600 text-white shadow scale-105'
                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
            }}">
            {{ $label }}
        </a>

        @endforeach

    </div>

</div>



<!-- ================= LIST ================= -->
<div class="max-w-5xl mx-auto p-6 space-y-5">
@php
    $filteredOrders = $orders;

    if(isset($status) && $status != 'all'){

        $filteredOrders = $orders->filter(function($order) use ($status){

            switch($status){

                case 'belum_lunas':
                    return $order->order_status === 'waiting'
                        && in_array($order->payment_status, ['pending','uploaded']);

                case 'diproses':
                    return in_array($order->order_status, ['ready','assigned','on_the_way','ongoing']);

                case 'selesai':
                    return $order->order_status === 'completed';

                case 'dibatalkan':
                    return $order->order_status === 'cancelled';

                case 'rescheduled':
                    return $order->order_status === 'rescheduled';

                default:
                    return true;
            }

        })->values(); // 🔥 reset index (best practice)
    }
@endphp

@forelse($filteredOrders as $order)

@php
    $badgeText  = '';
    $badgeClass = '';

    switch(true){

        case $order->order_status === 'cancelled':
            $badgeText  = 'Dibatalkan';
            $badgeClass = 'bg-red-100 text-red-600';
            break;

        case $order->order_status === 'completed':
            $badgeText  = 'Selesai';
            $badgeClass = 'bg-green-100 text-green-600';
            break;

        case $order->order_status === 'rescheduled':
            $badgeText  = 'Reschedule';
            $badgeClass = 'bg-purple-100 text-purple-600';
            break;

        case $order->order_status === 'ongoing':
            $badgeText  = 'Sedang Berlangsung';
            $badgeClass = 'bg-blue-200 text-blue-800';
            break;

        case $order->order_status === 'on_the_way':
            $badgeText  = 'OTW';
            $badgeClass = 'bg-blue-100 text-blue-700';
            break;

        case $order->order_status === 'assigned':
            $badgeText  = 'Ditugaskan';
            $badgeClass = 'bg-blue-100 text-blue-700';
            break;

        case $order->order_status === 'ready':
            $badgeText  = 'Siap';
            $badgeClass = 'bg-blue-100 text-blue-700';
            break;

        case $order->order_status === 'waiting':

            if($order->payment_status === 'uploaded'){
                $badgeText  = 'Verifikasi';
                $badgeClass = 'bg-yellow-100 text-yellow-700';
            }
            elseif($order->payment_status === 'failed'){
                $badgeText  = 'Ditolak';
                $badgeClass = 'bg-red-100 text-red-600';
            }
            elseif($order->payment_status === 'expired'){
                $badgeText  = 'Expired';
                $badgeClass = 'bg-gray-200 text-gray-700';
            }
            else{
                $badgeText  = 'Belum Bayar';
                $badgeClass = 'bg-yellow-100 text-yellow-700';
            }

            break;

        default:
            $badgeText  = 'Unknown';
            $badgeClass = 'bg-gray-100 text-gray-600';
            break;
    }

    $isProcess = in_array($order->order_status, ['ready','assigned','on_the_way','ongoing']);
@endphp


<div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition border border-gray-100 p-5">

    <!-- HEADER -->
    <div class="flex justify-between items-start mb-4">

        <div>
            <p class="font-semibold text-gray-800">
                {{ $order->transaction_code }}
            </p>

            <p class="text-xs text-gray-400 mt-1">
                {{ $order->created_at->format('d M Y H:i') }}
            </p>
        </div>

        <span class="text-xs px-3 py-1 rounded-full font-medium {{ $badgeClass }}">
            {{ $badgeText }}
        </span>

    </div>


    <!-- SERVICES -->
    <div class="text-sm space-y-2 mb-4">

        @foreach($order->services as $service)

        <div class="flex justify-between items-center">

            <span class="text-gray-700">
                {{ $service->service_name }}
            </span>

            <span class="text-gray-400 text-xs">
                {{ $service->duration }} menit
            </span>

        </div>

        @endforeach

    </div>


    <!-- STATUS MESSAGE -->
    @if($isProcess)
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 text-xs text-blue-700 mb-3">
        🚀 Pesanan sedang diproses
    </div>
    @endif

    @if($order->order_status === 'completed')
    <div class="bg-green-50 border border-green-100 rounded-xl p-3 text-xs text-green-700 mb-3">
        ✅ Layanan selesai
    </div>
    @endif

    @if($order->order_status === 'cancelled')
    <div class="bg-red-50 border border-red-100 rounded-xl p-3 text-xs text-red-700 mb-3">
        ❌ Dibatalkan
        @if($order->cancel_reason)
        <div class="text-gray-500 mt-1">
            {{ $order->cancel_reason }}
        </div>
        @endif
    </div>
    @endif

    @if($order->order_status === 'rescheduled')
    <div class="bg-purple-50 border border-purple-100 rounded-xl p-3 text-xs text-purple-700 mb-3">
        🔄 {{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}
        {{ $order->service_time }}
    </div>
    @endif


    <!-- FOOTER -->
    <div class="flex justify-between items-center pt-3 border-t">

        <span class="text-xs text-gray-400 uppercase tracking-wide">
            {{ $order->payment_method }}
        </span>

        <div class="flex items-center gap-4">

            <span class="font-semibold text-teal-600 text-sm">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </span>

            @php
                $isPending = in_array($order->payment_status, ['pending','uploaded']);
            @endphp

            <a href="{{ $isPending 
                    ? route('customer.orders.show', $order->id) 
                    : route('customer.detail', $order->id) }}"
                class="text-xs bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg shadow transition">
                Detail →
            </a>

        </div>

    </div>

</div>

@empty

<div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">
    Belum ada pesanan.
</div>

@endforelse

</div>

@endsection