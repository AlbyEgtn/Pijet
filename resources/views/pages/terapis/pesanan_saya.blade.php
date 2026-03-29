@extends('layouts.terapis')

@section('title','Pesanan Saya')

@section('content')

<div class="p-4 space-y-4">

    <h1 class="text-lg font-semibold">Pesanan Saya</h1>

    @forelse($transactions as $trx)
    <div class="bg-white p-4 rounded-xl shadow space-y-3">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $trx->customer_name }}</p>
                <p class="text-xs text-gray-500">
                    ID {{ $trx->transaction_code }}
                </p>
            </div>

            <span class="text-xs px-2 py-1 rounded
                @if($trx->status == 'proses') bg-blue-100 text-blue-600
                @elseif($trx->status == 'lunas') bg-green-100 text-green-600
                @else bg-gray-100 text-gray-600
                @endif
            ">
                {{ ucfirst(str_replace('_',' ',$trx->status)) }}
            </span>
        </div>

        <!-- DETAIL -->
        <div class="text-sm text-gray-600">
            <p>{{ $trx->service_date }} • {{ $trx->service_time }}</p>
            <p>{{ $trx->customer_address }}</p>
        </div>

        <!-- TOTAL -->
        <div class="flex justify-between font-semibold">
            <span>Total</span>
            <span>Rp{{ number_format($trx->total_price,0,',','.') }}</span>
        </div>

        <!-- ACTION -->
        <div class="flex gap-2">

            <a href="{{ route('terapis.pesanan.saya.detail', $trx->id) }}"
               class="flex-1 text-center bg-teal-600 text-white py-2 rounded-lg">
                Detail
            </a>

            @if($trx->status == 'proses')
            <form action="#" method="POST" class="flex-1">
                @csrf
                <button class="w-full border border-red-500 text-red-500 py-2 rounded-lg">
                    Batalkan
                </button>
            </form>
            @endif

        </div>

    </div>
    @empty
    <div class="text-center text-gray-500 mt-10">
        Belum ada pesanan
    </div>
    @endforelse

</div>

@endsection