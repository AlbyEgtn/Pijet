@extends('layouts.terapis')

@section('title','Detail Pesanan')
@section('header','Detail Pesanan')

@section('content')

<div class="p-4 md:p-6 max-w-5xl mx-auto space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-5 md:p-6 rounded-3xl shadow-lg">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <p class="text-sm opacity-80">
                    Terapis
                </p>

                <h1 class="text-2xl font-bold mt-1">
                    {{ auth()->user()->name }}
                </h1>

                <p class="text-xs opacity-70 mt-1">
                    ID ORDER : {{ $transaction->transaction_code }}
                </p>

            </div>

            <div>

                <span class="
                    px-4 py-2 rounded-full text-sm font-semibold

                    @if($transaction->order_status == 'assigned')
                        bg-blue-500/20 text-blue-100
                    @elseif($transaction->order_status == 'ongoing')
                        bg-purple-500/20 text-purple-100
                    @elseif($transaction->order_status == 'completed')
                        bg-green-500/20 text-green-100
                    @elseif($transaction->order_status == 'cancelled')
                        bg-red-500/20 text-red-100
                    @else
                        bg-white/20 text-white
                    @endif
                ">

                    {{ ucfirst(str_replace('_',' ',$transaction->order_status)) }}

                </span>

            </div>

        </div>

    </div>


    <!-- ================= STATUS TRACKER ================= -->
    <div class="bg-white rounded-3xl shadow-sm p-5 md:p-6">

        <div class="flex items-center justify-between text-[11px] md:text-sm">

            <!-- READY -->
            <div class="flex flex-col items-center flex-1">

                <div class="
                    w-10 h-10 rounded-full flex items-center justify-center font-bold

                    {{ in_array($transaction->order_status, ['ready','assigned','ongoing','completed'])
                        ? 'bg-green-500 text-white'
                        : 'bg-gray-200 text-gray-500'
                    }}
                ">
                    ✓
                </div>

                <p class="mt-2 font-medium">
                    Ready
                </p>

            </div>

            <div class="h-1 flex-1 bg-gray-200 mx-1"></div>

            <!-- ASSIGNED -->
            <div class="flex flex-col items-center flex-1">

                <div class="
                    w-10 h-10 rounded-full flex items-center justify-center font-bold

                    {{ in_array($transaction->order_status, ['assigned','ongoing','completed'])
                        ? 'bg-blue-500 text-white'
                        : 'bg-gray-200 text-gray-500'
                    }}
                ">
                    ✓
                </div>

                <p class="mt-2 font-medium">
                    Assigned
                </p>

            </div>

            <div class="h-1 flex-1 bg-gray-200 mx-1"></div>

            <!-- ONGOING -->
            <div class="flex flex-col items-center flex-1">

                <div class="
                    w-10 h-10 rounded-full flex items-center justify-center font-bold

                    {{ in_array($transaction->order_status, ['ongoing','completed'])
                        ? 'bg-purple-500 text-white'
                        : 'bg-gray-200 text-gray-500'
                    }}
                ">
                    ✓
                </div>

                <p class="mt-2 font-medium">
                    Ongoing
                </p>

            </div>

            <div class="h-1 flex-1 bg-gray-200 mx-1"></div>

            <!-- COMPLETED -->
            <div class="flex flex-col items-center flex-1">

                <div class="
                    w-10 h-10 rounded-full flex items-center justify-center font-bold

                    {{ $transaction->order_status == 'completed'
                        ? 'bg-green-600 text-white'
                        : 'bg-gray-200 text-gray-500'
                    }}
                ">
                    ✓
                </div>

                <p class="mt-2 font-medium">
                    Completed
                </p>

            </div>

        </div>

    </div>


    <!-- ================= CUSTOMER ================= -->
    <div class="bg-white rounded-3xl shadow-sm p-5 md:p-6 space-y-5">

        <div class="flex items-start justify-between gap-4">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    {{ $transaction->customer_name }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Customer Pemesanan
                </p>

            </div>

            <div>

                <span class="
                    px-3 py-1 rounded-full text-xs font-semibold

                    @if($transaction->payment_status == 'verified')
                        bg-green-100 text-green-700
                    @else
                        bg-yellow-100 text-yellow-700
                    @endif
                ">

                    {{ strtoupper($transaction->payment_status) }}

                </span>

            </div>

        </div>


        <!-- ================= SUMMARY ================= -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="bg-gray-50 rounded-2xl p-4">

                <p class="text-xs text-gray-400">
                    Total Layanan
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-2">

                    {{ $transaction->services->count() }}

                </p>

            </div>

            <div class="bg-gray-50 rounded-2xl p-4">

                <p class="text-xs text-gray-400">
                    Estimasi Durasi
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-2">

                    {{ $transaction->services->sum('duration') }}

                    <span class="text-sm font-medium">
                        Menit
                    </span>

                </p>

            </div>

            <div class="bg-gray-50 rounded-2xl p-4">

                <p class="text-xs text-gray-400">
                    Metode Bayar
                </p>

                <p class="text-lg font-bold text-gray-800 mt-2">

                    {{ strtoupper($transaction->payment_method) }}

                </p>

            </div>

            <div class="bg-gray-50 rounded-2xl p-4">

                <p class="text-xs text-gray-400">
                    Total Pembayaran
                </p>

                <p class="text-lg font-bold text-teal-600 mt-2">

                    Rp{{ number_format($transaction->total_price,0,',','.') }}

                </p>

            </div>

        </div>


        <!-- ================= DETAIL ================= -->
        <div class="grid md:grid-cols-2 gap-5 border-t pt-5">

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Tanggal Layanan
                </p>

                <p class="font-semibold text-gray-800 mt-1">

                    {{ \Carbon\Carbon::parse($transaction->service_date)->format('d F Y') }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Jam Layanan
                </p>

                <p class="font-semibold text-gray-800 mt-1">

                    {{ $transaction->service_time }}

                </p>

            </div>

            <div class="md:col-span-2">

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Alamat Customer
                </p>

                <div class="mt-2 bg-gray-50 rounded-2xl p-4">

                    <p class="font-medium text-gray-700 leading-relaxed">

                        {{ $transaction->customer_address }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= QUICK ACTION ================= -->
    <div class="grid grid-cols-2 gap-4">

        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($transaction->customer_address) }}"
           target="_blank"
           class="bg-blue-500 hover:bg-blue-600 transition text-white text-center py-4 rounded-2xl font-medium">

            📍 Buka Maps

        </a>

        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $transaction->customer->phone ?? '') }}"
           target="_blank"
           class="bg-green-500 hover:bg-green-600 transition text-white text-center py-4 rounded-2xl font-medium">

            💬 Chat Customer

        </a>

    </div>


    <!-- ================= LAYANAN ================= -->
    <div class="bg-white rounded-3xl shadow-sm p-5 md:p-6">

        <div class="flex items-center justify-between mb-5">

            <h3 class="text-lg font-bold text-gray-800">
                Detail Layanan
            </h3>

            <span class="text-sm text-gray-500">

                {{ $transaction->services->count() }} layanan

            </span>

        </div>

        <div class="space-y-4">

            @foreach($transaction->services as $service)

            <div class="border rounded-2xl p-4 hover:bg-gray-50 transition">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <h4 class="font-semibold text-gray-800">

                            {{ $service->service_name }}

                        </h4>

                        <p class="text-sm text-gray-500 mt-1">

                            Durasi {{ $service->duration }} menit

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold text-teal-600">

                            Rp{{ number_format($service->service_price ?? 0,0,',','.') }}

                        </p>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>


    <!-- ================= TIMER ================= -->
    @php

        $duration = 0;

        if ($transaction->started_at) {

            $end = $transaction->completed_at ?? now();

            $duration = \Carbon\Carbon::parse($transaction->started_at)
                ->diffInSeconds($end, false);

            $duration = intval($duration);
        }

    @endphp

    <div class="bg-white rounded-3xl shadow-sm p-6 text-center">

        <p class="text-sm text-gray-400 uppercase tracking-wide">
            Durasi Layanan
        </p>

        <p id="timer"
           class="text-4xl md:text-5xl font-bold text-gray-800 mt-3">

            00:00:00

        </p>

        @if($transaction->order_status == 'assigned')

        <form action="{{ route('terapis.pesanan.mulai', $transaction->id) }}"
              method="POST">

            @csrf

            <button class="mt-5 bg-blue-500 hover:bg-blue-600 transition text-white px-6 py-3 rounded-2xl font-medium">

                Mulai Layanan

            </button>

        </form>

        @endif

    </div>


    <!-- ================= ACTION ================= -->
    <div class="space-y-4">

        @if($transaction->order_status == 'ongoing')

        <form action="{{ route('terapis.pesanan.selesai', $transaction->id) }}"
              method="POST">

            @csrf

            <button class="w-full bg-teal-600 hover:bg-teal-700 transition text-white py-4 rounded-2xl font-semibold">

                Selesaikan Layanan

            </button>

        </form>

        @else

        <div class="w-full bg-gray-100 text-center py-4 rounded-2xl text-gray-400 font-medium">

            Selesaikan Layanan

        </div>

        @endif


        @if(in_array($transaction->order_status, ['assigned','on_the_way']))

        <form action="{{ route('terapis.pesanan.batal', $transaction->id) }}"
              method="POST">

            @csrf

            <button class="w-full bg-red-500 hover:bg-red-600 transition text-white py-4 rounded-2xl font-semibold">

                Batalkan Pesanan

            </button>

        </form>

        @endif

    </div>

</div>


<!-- ================= TIMER SCRIPT ================= -->
<script>

    let seconds = Math.floor({{ $duration }});

    function formatTime(sec) {

        let h = String(Math.floor(sec / 3600)).padStart(2, '0');
        let m = String(Math.floor((sec % 3600) / 60)).padStart(2, '0');
        let s = String(sec % 60).padStart(2, '0');

        return `${h}:${m}:${s}`;
    }

    document.getElementById('timer').innerText = formatTime(seconds);

    @if($transaction->order_status == 'ongoing')

    setInterval(() => {

        seconds++;

        document.getElementById('timer').innerText = formatTime(seconds);

    }, 1000);

    @endif

</script>

@endsection
