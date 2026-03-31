@extends('layouts.terapis')

@section('content')

<div class="p-4 space-y-4">

    <h1 class="text-lg font-semibold">Detail Pesanan</h1>

    <div class="bg-gray-100 p-4 rounded-xl space-y-4">

        <!-- CUSTOMER -->
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $transaction->customer_name }}</p>
                <p class="text-xs text-gray-500">
                    ID {{ $transaction->transaction_code }}
                </p>
            </div>

            <span class="text-xs
                @if($transaction->status == 'belum_lunas') text-green-500
                @else text-gray-400
                @endif">
                {{ ucfirst(str_replace('_',' ',$transaction->status)) }}
            </span>
        </div>

        <!-- DETAIL -->
        <div class="text-sm space-y-1">
            <p><strong>Tanggal:</strong> {{ $transaction->service_date }}</p>
            <p><strong>Jam:</strong> {{ $transaction->service_time }}</p>
            <p><strong>Alamat:</strong> {{ $transaction->customer_address }}</p>
        </div>

        <!-- TOTAL -->
        <div class="flex justify-between font-semibold text-lg border-t pt-3">
            <span>Total</span>
            <span>Rp{{ number_format($transaction->total_price,0,',','.') }}</span>
        </div>

        <!-- BUTTON LOGIC -->
        @if($transaction->status == 'belum_lunas')
            <form action="{{ route('terapis.pesanan.ambil', $transaction->id) }}" method="POST">
                @csrf
                <button class="w-full bg-teal-600 text-white py-2 rounded-xl hover:bg-teal-700">
                    Ambil Pesanan
                </button>
            </form>
        @else
            <button disabled
                class="w-full bg-gray-300 text-gray-600 py-2 rounded-xl cursor-not-allowed">
                Tidak Bisa Diambil
            </button>
        @endif

    </div>

</div>

@endsection