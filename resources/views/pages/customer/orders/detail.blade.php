@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex items-center gap-4 text-white">

        <a href="{{ route('customer.orders') }}"
           class="text-xl bg-white/20 p-2 rounded-full hover:bg-white/30 transition">
            ←
        </a>

        <div>
            <h1 class="text-2xl font-semibold">
                Detail Pesanan
            </h1>
            <p class="text-sm opacity-90">
                Status & progress layanan Anda
            </p>
        </div>

    </div>

</section>


@php
    $steps = [
        'waiting'   => 'Order Dibuat',
        'verified'  => 'Pembayaran',
        'ready'     => 'Siap',
        'assigned'  => 'Terapis Berangkat',
        'ongoing'   => 'Sedang Berjalan',
        'completed' => 'Selesai'
    ];

    $current = $order->order_status;

    if($order->payment_status !== 'verified'){
        $current = 'waiting';
    }

    $keys = array_keys($steps);
    $currentIndex = array_search($current, $keys);
@endphp


<div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ================= MAIN ================= -->
    <div class="lg:col-span-2 space-y-6">

        <!-- STATUS CARD -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 text-center">

            <div id="status-icon" class="text-4xl mb-3">
                @if($order->payment_method === 'cash')
                    💰
                @elseif($order->payment_status === 'verified')
                    ✔
                @else
                    ⏳
                @endif
            </div>

            <h2 id="status-title" class="text-lg font-semibold text-gray-800">
                @if($order->payment_method === 'cash')
                    Pembayaran di Tempat
                @elseif($order->payment_status === 'verified')
                    Pembayaran Berhasil
                @else
                    Menunggu Pembayaran
                @endif
            </h2>

            <p id="status-desc" class="text-sm text-gray-400 mt-1">
                @if($order->payment_method === 'cash')
                    Silakan bayar langsung ke terapis
                @elseif($order->payment_status === 'verified')
                    Pesanan sedang diproses
                @else
                    Menunggu pembayaran
                @endif
            </p>

        </div>


        <!-- TRACKING -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6">

            <h3 class="font-semibold mb-6 text-gray-800">
                Tracking Pesanan
            </h3>

            <div class="flex items-center justify-between">

                @foreach($steps as $key => $label)

                @php
                    $index = array_search($key, $keys);
                    $isDone = $index < $currentIndex;
                    $isActive = $index === $currentIndex;
                @endphp

                <div class="flex-1 flex items-center">

                    <div class="flex flex-col items-center w-full text-center">

                        <div 
                            class="w-9 h-9 rounded-full flex items-center justify-center text-xs step
                            {{ $isDone ? 'bg-green-500 text-white' : '' }}
                            {{ $isActive ? 'bg-teal-600 text-white animate-pulse' : '' }}
                            {{ (!$isDone && !$isActive) ? 'bg-gray-200 text-gray-400' : '' }}"
                            data-step="{{ $key }}"
                        >
                            @if($isDone) ✓
                            @elseif($isActive) ●
                            @else ○
                            @endif
                        </div>

                        <p class="text-xs mt-2 text-gray-500">
                            {{ $label }}
                        </p>

                    </div>

                    @if(!$loop->last)
                    <div class="flex-1 h-1 mx-2
                        {{ $index < $currentIndex ? 'bg-green-500' : 'bg-gray-200' }}">
                    </div>
                    @endif

                </div>

                @endforeach

            </div>

        </div>

    </div>


    <!-- ================= SIDEBAR ================= -->
    <div class="space-y-6">

        <!-- DETAIL -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">

            <h3 class="font-semibold mb-3 text-gray-800">
                Detail Pesanan
            </h3>

            <div class="text-sm text-gray-500 space-y-2">

                <p><b>Kode:</b> {{ $order->transaction_code }}</p>

                <p>{{ $order->customer_address }}</p>
                <p>{{ $order->customer_city }}</p>

                <p>
                    {{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}
                    • {{ $order->service_time }}
                </p>

            </div>

        </div>


        <!-- SERVICES -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">

            <h3 class="font-semibold mb-3 text-gray-800">
                Layanan
            </h3>

            @foreach($order->services as $service)

            <div class="flex justify-between items-center text-sm mb-2">

                <span class="text-gray-700">
                    {{ $service->service_name }}
                </span>

                <span class="text-gray-400 text-xs">
                    {{ $service->duration }} menit
                </span>

            </div>

            @endforeach

        </div>


        <!-- TOTAL -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 flex justify-between font-semibold">

            <span>Total</span>

            <span class="text-teal-600">
                Rp {{ number_format($order->total_price) }}
            </span>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

const orderId = {{ $order->id }};

/* ================= UPDATE UI ================= */

function updateUI(data){

    const steps = [
        'waiting',
        'verified',
        'ready',
        'assigned',
        'ongoing',
        'completed'
    ];

    let current = data.order_status;

    if(data.payment_status !== 'verified'){
        current = 'waiting';
    }

    const currentIndex = steps.indexOf(current);

    /* ===== UPDATE STEP ===== */
    document.querySelectorAll('.step').forEach(el => {

        const key = el.dataset.step;
        const index = steps.indexOf(key);

        el.className = "w-8 h-8 rounded-full flex items-center justify-center text-xs step";

        if(index < currentIndex){
            el.classList.add('bg-green-500','text-white');
            el.innerText = '✓';
        }
        else if(index === currentIndex){
            el.classList.add('bg-teal-600','text-white','animate-pulse');
            el.innerText = '●';
        }
        else{
            el.classList.add('bg-gray-200','text-gray-400');
            el.innerText = '○';
        }

    });

    /* ===== UPDATE STATUS TEXT ===== */
    const title = document.getElementById("status-title");
    const desc  = document.getElementById("status-desc");
    const icon  = document.getElementById("status-icon");

    if(data.payment_status === 'verified'){
        title.innerText = "Pembayaran Berhasil";
        desc.innerText  = "Pesanan sedang diproses";
        icon.innerText  = "✔";
    } else {
        title.innerText = "Menunggu Pembayaran";
        desc.innerText  = "Silakan selesaikan pembayaran";
        icon.innerText  = "⏳";
    }

}


/* ================= REALTIME POLLING ================= */

const interval = setInterval(() => {

    fetch(`/customer/orders/${orderId}/status`)
    .then(res => res.json())
    .then(data => {

        updateUI(data);

        // stop kalau selesai
        if(data.order_status === 'completed'){
            clearInterval(interval);
        }

    })
    .catch(err => console.error(err));

}, 5000);

</script>
@endpush