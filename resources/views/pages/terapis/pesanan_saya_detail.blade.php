@extends('layouts.terapis')

@section('content')

<div class="p-4 space-y-4">

    <!-- HEADER -->
    <div class="bg-teal-700 text-white p-4 rounded-xl flex justify-between">
        <span>{{ auth()->user()->name }}</span>
        <span>Terapis</span>
    </div>

    <!-- CARD -->
    <div class="bg-gray-100 p-4 rounded-xl space-y-3">

        <div class="flex justify-between">
            <div>
                <p class="font-semibold">{{ $transaction->customer_name }}</p>
                <p class="text-xs text-gray-500">
                    ID {{ $transaction->transaction_code }}
                </p>
            </div>

            <span class="text-xs text-blue-500">
                {{ ucfirst(str_replace('_',' ',$transaction->status)) }}
            </span>
        </div>

        <!-- LAYANAN -->
        <div class="text-sm">
            <p>{{ $transaction->service_date }} {{ $transaction->service_time }}</p>
        </div>

        <!-- TOTAL -->
        <div class="flex justify-between font-semibold">
            <span>Total</span>
            <span>Rp{{ number_format($transaction->total_price,0,',','.') }}</span>
        </div>

    </div>

    <!-- INFO -->
    <div class="bg-gray-100 p-4 rounded-xl text-sm space-y-2">
        <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</p>
        <p><strong>Alamat:</strong> {{ $transaction->customer_address }}</p>
    </div>

    <!-- TIMER -->
    <div class="bg-gray-100 p-4 rounded-xl text-center">
        <p class="text-sm text-gray-500">Timer</p>
        <p class="text-2xl font-bold">00:00:00</p>
        <button class="mt-2 bg-gray-400 text-white px-4 py-1 rounded">
            Mulai
        </button>
    </div>

    <!-- BUTTON SELESAI -->
    @if($transaction->status == 'proses')
    <form action="#" method="POST">
        @csrf
        <button class="w-full bg-teal-600 text-white py-3 rounded-xl">
            Selesai
        </button>
    </form>
    @else
    <div class="w-full bg-gray-300 text-center py-3 rounded-xl text-gray-600">
        Selesai
    </div>
    @endif

</div>

@endsection