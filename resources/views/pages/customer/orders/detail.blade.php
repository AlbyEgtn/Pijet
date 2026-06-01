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

        <!-- ================= STATUS CARD ================= -->

        @php

            $statusTitle = '';
            $statusDesc  = '';
            $statusIcon  = '';
            $statusClass = '';

            switch($order->order_status){

                case 'completed':

                    $statusTitle = 'Layanan Selesai';
                    $statusDesc  = 'Terima kasih telah menggunakan layanan kami';
                    $statusIcon  = '🎉';
                    $statusClass = '
                        bg-gradient-to-r
                        from-emerald-600
                        to-teal-700
                    ';
                break;


                case 'ongoing':

                    $statusTitle = 'Layanan Sedang Berjalan';
                    $statusDesc  = 'Therapist sedang melakukan layanan';
                    $statusIcon  = '💆';
                    $statusClass = '
                        bg-gradient-to-r
                        from-teal-600
                        to-teal-800
                    ';
                break;


                case 'assigned':

                    $statusTitle = 'Therapist Sedang Menuju Lokasi';
                    $statusDesc  = 'Therapist sedang dalam perjalanan';
                    $statusIcon  = '🚗';
                    $statusClass = '
                        bg-gradient-to-r
                        from-teal-700
                        to-emerald-700
                    ';
                break;


                case 'ready':

                    $statusTitle = 'Pesanan Siap Diproses';
                    $statusDesc  = 'Menunggu therapist mengambil pesanan';
                    $statusIcon  = '📦';
                    $statusClass = '
                        bg-gradient-to-r
                        from-slate-700
                        to-slate-800
                    ';
                break;


                default:

                    if($order->payment_status === 'verified'){

                        $statusTitle = 'Pembayaran Berhasil';
                        $statusDesc  = 'Pesanan sedang diproses';
                        $statusIcon  = '✔';
                        $statusClass = '
                            bg-gradient-to-r
                            from-teal-700
                            to-emerald-700
                        ';
                    }else{

                        $statusTitle = 'Menunggu Pembayaran';
                        $statusDesc  = 'Silakan selesaikan pembayaran';
                        $statusIcon  = '⏳';
                        $statusClass = '
                            bg-gradient-to-r
                            from-gray-700
                            to-gray-900
                        ';                    }
                break;
            }

        @endphp


        <div class="{{ $statusClass  }} rounded-3xl shadow-lg overflow-hidden">

            <div class="p-8 text-white text-center">

                <div class="text-6xl mb-4 animate-bounce">

                    {{ $statusIcon }}

                </div>

                <h2 class="text-2xl font-bold">

                    {{ $statusTitle }}

                </h2>

                <p class="text-white/80 mt-2">

                    {{ $statusDesc }}

                </p>

            </div>

        </div>

        <!-- ================= TRACKING ================= -->

        @php

            $steps = [

                'waiting'   => 'Order Dibuat',
                'verified'  => 'Pembayaran',
                'ready'     => 'Siap',
                'assigned'  => 'Terapis Berangkat',
                'ongoing'   => 'Sedang Berjalan',
                'completed' => 'Selesai'
            ];


            // ======================
            // CURRENT STATUS
            // ======================

            if($order->order_status == 'completed'){

                $current = 'completed';

            }elseif($order->order_status == 'ongoing'){

                $current = 'ongoing';

            }elseif($order->order_status == 'assigned'){

                $current = 'assigned';

            }elseif($order->order_status == 'ready'){

                $current = 'ready';

            }elseif($order->payment_status == 'verified'){

                $current = 'verified';

            }else{

                $current = 'waiting';
            }

            $keys = array_keys($steps);

            $currentIndex = array_search($current, $keys);

        @endphp


        <div class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition p-6">

            <div class="flex items-center justify-between gap-2 overflow-x-auto">

                @foreach($steps as $key => $label)

                @php

                    $index = array_search($key, $keys);

                    $isDone = $index < $currentIndex;

                    $isActive = $index === $currentIndex;

                @endphp

                <div class="flex items-center flex-1 min-w-[90px]">

                    <div class="flex flex-col items-center w-full text-center">

                        <!-- ICON -->
                        <div
                            class="
                                w-12 h-12 rounded-full flex items-center justify-center
                                text-sm font-bold transition-all duration-300

                                {{ $isDone ? 'bg-teal-600 text-white shadow-lg' : '' }}

                                {{ $isActive ? 'bg-emerald-700 text-white scale-110 shadow-xl animate-pulse' : '' }}

                                {{ (!$isDone && !$isActive) ? 'bg-gray-200 text-gray-400' : '' }}
                            "
                        >

                            @if($isDone)

                                ✓

                            @elseif($isActive)

                                ●

                            @else

                                ○

                            @endif

                        </div>

                        <!-- LABEL -->
                        <p class="
                            text-xs mt-3 leading-tight

                            {{ $isActive
                                ? 'text-teal-700 font-semibold'
                                : 'text-gray-500'
                            }}
                        ">

                            {{ $label }}

                        </p>

                    </div>

                    @if(!$loop->last)

                    <div class="
                        flex-1 h-1 rounded-full mx-2

                        {{ $index < $currentIndex
                            ? 'bg-green-500'
                            : 'bg-gray-200'
                        }}
                    "></div>

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

        {{-- ================= TERAPIS ================= --}}
        @if($order->terapis)

        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">

            <div class="flex items-start justify-between gap-4">

                <div class="flex items-start gap-4">

                    {{-- FOTO --}}
                    <img
                        src="{{ $order->terapis->user->foto
                            ? asset('storage/'.$order->terapis->user->foto)
                            : 'https://ui-avatars.com/api/?name='.urlencode($order->terapis->user->name) }}"
                        class="w-16 h-16 rounded-2xl object-cover border"
                    >

                    <div>

                        <h3 class="font-semibold text-gray-800 text-lg">

                            {{ $order->terapis->user->name }}

                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            Terapis Professional
                        </p>

                        {{-- RATING --}}
                        <div class="flex items-center gap-2 mt-2">

                            <span class="text-yellow-500">
                                ⭐
                            </span>

                            <span class="font-semibold text-gray-700">

                                {{ round($order->terapis->user->reviewsReceived()->avg('rating') ?? 0, 1) }}

                            </span>

                            <span class="text-xs text-gray-400">

                                ({{ $order->terapis->user->reviewsReceived()->count() }} ulasan)

                            </span>

                        </div>

                    </div>

                </div>


                {{-- BUTTON --}}
                @php

                    $alreadyReviewed = \App\Models\TherapistReview::where('customer_id', auth()->id())
                        ->where('therapist_id', $order->terapis->user->id)
                        ->exists();

                @endphp

                @if(
                    $order->order_status === 'completed'
                    && !$alreadyReviewed
                )

                <button
                    onclick="openReviewModal()"
                    class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-4 py-2 rounded-xl text-sm font-medium"
                >

                    ⭐ Rating

                </button>

                @endif

            </div>

        </div>

        @endif


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

        {{-- ACTION --}}
        @if(
            in_array($order->order_status, ['waiting','ready','assigned']) 
            && $order->payment_status !== 'verified'
        )

        <div class="action-card bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 space-y-4">

            {{-- CANCEL --}}
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                @csrf

                <textarea name="cancel_reason"
                    class="w-full border p-2 rounded-xl mb-2"
                    placeholder="Alasan pembatalan..."
                    required></textarea>

                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl transition">
                    Batalkan Pesanan
                </button>
            </form>

            {{-- RESCHEDULE --}}
            <form action="{{ route('customer.orders.reschedule', $order->id) }}" method="POST">
                @csrf

                <input type="date" name="new_date"
                    class="w-full border p-2 rounded-xl mb-2" required>

                <input type="time" name="new_time"
                    class="w-full border p-2 rounded-xl mb-2" required>

                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
                    Reschedule
                </button>
            </form>

        </div>

        @endif


        <!-- TOTAL -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 flex justify-between font-semibold">

            <span>Total</span>

            <span class="text-teal-600">
                Rp {{ number_format($order->total_price) }}
            </span>

        </div>

    </div>

</div>

{{-- ================= REVIEW MODAL ================= --}}
<div
    id="reviewModal"
    class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4"
>

    <div class="bg-white rounded-3xl w-full max-w-md p-6 relative animate-fadeIn">

        {{-- CLOSE --}}
        <button
            onclick="closeReviewModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
        >
            ✕
        </button>

        <h2 class="text-xl font-bold text-gray-800 mb-1">
            Beri Rating Terapis
        </h2>

        <p class="text-sm text-gray-400 mb-6">
            Bagikan pengalaman layanan Anda
        </p>

        <form
            action="{{ route('customer.review.store', $order->id) }}"
            method="POST"
            class="space-y-5"
        >

            @csrf

            {{-- STAR --}}
            <div class="text-center">

                <div class="flex justify-center gap-2 text-4xl">

                    @for($i=1; $i<=5; $i++)

                    <button
                        type="button"
                        class="star text-gray-300 transition hover:scale-110"
                        data-value="{{ $i }}"
                    >
                        ★
                    </button>

                    @endfor

                </div>

                <input
                    type="hidden"
                    name="rating"
                    id="ratingInput"
                    required
                >

            </div>

            {{-- REVIEW --}}
            <div>

                <textarea
                    name="review"
                    rows="4"
                    required
                    maxlength="500"
                    placeholder="Tulis pengalaman Anda..."
                    class="w-full border rounded-2xl p-4 focus:ring-2 focus:ring-teal-500 outline-none"
                ></textarea>

            </div>

            {{-- BUTTON --}}
            <button
                type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 transition text-white py-3 rounded-2xl font-medium"
            >

                Kirim Review

            </button>

        </form>

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

function handleActionVisibility(data){

    const actionCard = document.querySelector('.action-card');

    if(!actionCard) return;

    const allowedStatus = ['waiting','ready','assigned'];

    if(
        !allowedStatus.includes(data.order_status) ||
        data.payment_status === 'verified'
    ){
        actionCard.remove();
    }

}

function openReviewModal(){

    document.getElementById('reviewModal')
        .classList.remove('hidden');

    document.getElementById('reviewModal')
        .classList.add('flex');
}

function closeReviewModal(){

    document.getElementById('reviewModal')
        .classList.add('hidden');

    document.getElementById('reviewModal')
        .classList.remove('flex');
}


/* ================= STAR RATING ================= */

const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingInput');

stars.forEach(star => {

    star.addEventListener('click', () => {

        const value = star.dataset.value;

        ratingInput.value = value;

        stars.forEach(s => {

            if(s.dataset.value <= value){

                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400');

            }else{

                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
            }

        });

    });

});

</script>
@endpush