@extends('layouts.terapis')

@section('title','Bayar Hutang')
@section('header',' Pembayaran Hutang ')

@section('content')

<div class="p-6 max-w-xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-5 rounded-2xl shadow">
        <h1 class="text-lg font-semibold">Selesaikan Kewajiban Anda</h1>
        <p class="text-sm opacity-90">
            Anda memiliki kewajiban pembayaran ke perusahaan
        </p>
    </div>

    <!-- INFO ORDER -->
    <div class="bg-white p-5 rounded-2xl shadow space-y-2 text-sm">

        <div class="flex justify-between">
            <span class="text-gray-500">Kode Transaksi</span>
            <span class="font-medium">{{ $order->transaction_code }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Customer</span>
            <span class="font-medium">{{ $order->customer_name }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Total Transaksi</span>
            <span class="font-medium">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </span>
        </div>

    </div>

    <!-- HUTANG -->
    <div class="bg-white p-5 rounded-2xl shadow text-center space-y-3">

        <p class="text-gray-500 text-sm">Jumlah yang harus dibayar</p>

        <p class="text-3xl font-bold text-red-500">
            Rp {{ number_format($order->company_income,0,',','.') }}
        </p>

        <p class="text-xs text-gray-400">
            (30% dari total transaksi)
        </p>

    </div>

    <!-- QRIS -->
    <div class="bg-white p-5 rounded-2xl shadow text-center space-y-4">

        <h3 class="font-semibold">Scan QRIS</h3>

        <!-- QRIS DUMMY -->
        <div class="flex justify-center">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PAY-{{ $order->id }}"
                 class="rounded-lg border">
        </div>

        <p class="text-xs text-gray-500">
            Scan menggunakan aplikasi e-wallet / mobile banking
        </p>

    </div>

    <!-- ACTION -->
    <form action="{{ route('terapis.bayar.hutang.proses', $order->id) }}" method="POST">
        @csrf
        <button class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700">
            Saya Sudah Bayar
        </button>
    </form>

    <a href="{{ route('terapis.pesanan.saya') }}"
       class="block text-center text-sm text-gray-500 hover:underline">
        Bayar nanti
    </a>

</div>

@endsection