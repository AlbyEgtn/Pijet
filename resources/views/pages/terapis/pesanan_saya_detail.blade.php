@extends('layouts.terapis')

@section('title','Detail Pesanan')
@section('header',' Detail Pesanan ')

@section('content')

<div class="p-6 max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-5 rounded-2xl shadow flex justify-between items-center">

        <div>
            <p class="text-sm opacity-80">Terapis</p>
            <p class="font-semibold text-lg">{{ auth()->user()->name }}</p>
        </div>

        <span class="text-xs px-3 py-1 rounded-full bg-white/20">
            {{ ucfirst(str_replace('_',' ',$transaction->order_status)) }}
        </span>

    </div>

    <!-- MAIN CARD -->
    <div class="bg-white p-5 rounded-2xl shadow space-y-4">

        <!-- CUSTOMER -->
        <div class="flex justify-between items-center">

            <div>
                <p class="font-semibold text-gray-800 text-lg">
                    {{ $transaction->customer_name }}
                </p>
                <p class="text-xs text-gray-500">
                    ID {{ $transaction->transaction_code }}
                </p>
            </div>

            <span class="text-xs px-2 py-1 rounded-full font-medium
                @if($transaction->order_status == 'assigned') bg-blue-100 text-blue-600
                @elseif($transaction->order_status == 'ongoing') bg-purple-100 text-purple-600
                @elseif($transaction->order_status == 'completed') bg-green-100 text-green-600
                @elseif($transaction->order_status == 'cancelled') bg-red-100 text-red-600
                @else bg-gray-100 text-gray-600
                @endif
            ">
                {{ ucfirst(str_replace('_',' ',$transaction->order_status)) }}
            </span>

        </div>

        <!-- INFO -->
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">

            <div>
                <p class="text-gray-400">Tanggal</p>
                <p class="font-medium">
                    {{ \Carbon\Carbon::parse($transaction->service_date)->format('d M Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-400">Jam</p>
                <p class="font-medium">
                    {{ $transaction->service_time }}
                </p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-400">Alamat</p>
                <p class="font-medium">
                    {{ $transaction->customer_address }}
                </p>
            </div>

        </div>

        <!-- LAYANAN -->
        <div class="border-t pt-4 space-y-2">

            <h3 class="font-semibold text-gray-700">Layanan</h3>

            @foreach($transaction->services as $service)
            <div class="flex justify-between text-sm">

                <span>
                    {{ $service->service_name }}
                    <span class="text-gray-400">({{ $service->duration }} menit)</span>
                </span>

                <span class="font-medium text-teal-600">
                    Rp{{ number_format($service->price ?? 0,0,',','.') }}
                </span>

            </div>
            @endforeach

        </div>

        <!-- TOTAL -->
        <div class="flex justify-between items-center border-t pt-4 text-lg font-semibold">

            <span>Total</span>
            <span class="text-teal-600">
                Rp{{ number_format($transaction->total_price,0,',','.') }}
            </span>

        </div>

    </div>

    <!-- PAYMENT & EXTRA -->
    <div class="bg-white p-5 rounded-2xl shadow text-sm space-y-2">

        <h3 class="font-semibold text-gray-700">Informasi Tambahan</h3>

        <div class="flex justify-between">
            <span class="text-gray-500">Metode Pembayaran</span>
            <span class="font-medium">{{ $transaction->payment_method }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Status Pembayaran</span>
            <span class="font-medium">
                {{ ucfirst($transaction->payment_status) }}
            </span>
        </div>

    </div>

    <!-- TIMER -->
    @php
        $duration = 0;

        if ($transaction->started_at) {
            $end = $transaction->completed_at ?? now();
            $duration = \Carbon\Carbon::parse($transaction->started_at)
                ->diffInSeconds($end, false);

            $duration = intval($duration);
        }
    @endphp

    <div class="bg-white p-5 rounded-2xl shadow text-center">

        <p class="text-sm text-gray-500">Durasi Layanan</p>
        <p id="timer" class="text-3xl font-bold text-gray-800 mt-1">00:00:00</p>

        @if($transaction->order_status == 'assigned')
        <form action="{{ route('terapis.pesanan.mulai', $transaction->id) }}" method="POST">
            @csrf
            <button class="mt-3 bg-blue-500 text-white px-5 py-2 rounded-xl hover:bg-blue-600">
                Mulai Layanan
            </button>
        </form>
        @endif

    </div>

    <!-- ACTION -->
    <div class="space-y-3">

        @if($transaction->order_status == 'ongoing')
        <form action="{{ route('terapis.pesanan.selesai', $transaction->id) }}" method="POST">
            @csrf
            <button class="w-full bg-teal-600 text-white py-3 rounded-xl hover:bg-teal-700">
                Selesaikan Layanan
            </button>
        </form>
        @else
        <div class="w-full bg-gray-200 text-center py-3 rounded-xl text-gray-500">
            Selesaikan Layanan
        </div>
        @endif

        @if(in_array($transaction->order_status, ['assigned','on_the_way']))
        <form action="{{ route('terapis.pesanan.batal', $transaction->id) }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 text-white py-3 rounded-xl hover:bg-red-600">
                Batalkan Pesanan
            </button>
        </form>
        @endif

    </div>

</div>

<!-- TIMER SCRIPT -->
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