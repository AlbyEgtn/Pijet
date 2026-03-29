@extends('layouts.admin')

@section('title','Detail Status Order')
@section('header','Detail Status Order')

@section('content')

<div 
    x-data="{
        showPayment:false,
        showReject:false
    }"
    class="bg-[#E7F1EE] p-6 rounded-xl"
>

    <!-- BACK -->
    <a href="{{ route('admin.orders.status') }}" 
       class="flex items-center gap-2 text-sm text-gray-600 mb-4 hover:text-teal-600">

        ← Kembali ke Status Order

    </a>


    <!-- HEADER -->
    <div class="bg-white rounded-xl shadow p-5 mb-5">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-teal-600 font-semibold">
                    ID Pesanan : {{ $transaction->transaction_code }}
                </p>

                <p class="text-sm mt-1">
                    Status :
                    <span class="px-2 py-1 text-xs rounded {{ $transaction->status_badge }}">
                        {{ ucfirst(str_replace('_',' ',$transaction->status)) }}
                    </span>
                </p>

            </div>

            <div class="text-right text-sm text-gray-500">

                <p>
                    Tanggal :
                    <b>{{ $transaction->created_at->format('d M Y') }}</b>
                </p>

                <p>
                    Jam :
                    <b>{{ $transaction->created_at->format('H:i') }} WIB</b>
                </p>

            </div>

        </div>


        <!-- ACTION -->
        @if(in_array($transaction->status, ['belum_lunas','proses']))
        <div class="flex gap-3 mt-4">

            <form method="POST" action="{{ route('admin.orders.approve',$transaction->id) }}">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                    Konfirmasi
                </button>
            </form>

            <button 
                @click="showReject = true"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm"
            >
                Tolak
            </button>

        </div>
        @endif

    </div>



    <div class="grid grid-cols-3 gap-5">

        <!-- LEFT -->
        <div class="col-span-2 space-y-5">

            <!-- PEMESAN -->
            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-semibold mb-4">Informasi Pemesanan</h3>

                <div class="grid grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-400">Pemesan</p>
                        <p>{{ $transaction->orderer_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400">Customer</p>
                        <p>{{ $transaction->customer_name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400">No HP</p>
                        <p>{{ $transaction->customer_phone ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400">Tanggal Layanan</p>
                        <p>{{ $transaction->service_date }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400">Jam</p>
                        <p>{{ $transaction->service_time }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400">Kota</p>
                        <p>{{ $transaction->customer_city ?? '-' }}</p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-gray-400">Alamat</p>
                        <p>{{ $transaction->customer_address ?? '-' }}</p>
                    </div>

                    @if($transaction->status == 'dibatalkan' && $transaction->cancel_reason)
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mt-4">
                        <p class="font-semibold text-sm">Alasan Penolakan:</p>
                        <p class="text-sm">{{ $transaction->cancel_reason }}</p>
                    </div>
                    @endif

                </div>

            </div>



            <!-- SERVICES -->
            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-semibold mb-4">Detail Layanan</h3>

                @forelse($transaction->services as $service)

                <div class="border rounded-lg mb-4 overflow-hidden">

                    <div class="bg-teal-600 text-white px-4 py-2 text-sm font-semibold">
                        {{ $service->service_name }}
                    </div>

                    <div class="p-4 grid grid-cols-4 gap-3 text-sm">

                        <div>
                            <p class="text-gray-400">Terapis</p>
                            <p>{{ $service->therapist_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Durasi</p>
                            <p>{{ $service->duration }} menit</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Tambahan</p>
                            <p>{{ $service->additional_service ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Total Durasi</p>
                            <p>{{ $service->total_duration }} menit</p>
                        </div>

                    </div>

                </div>

                @empty
                <p class="text-gray-400 text-sm">Tidak ada layanan</p>
                @endforelse

            </div>

        </div>



        <!-- RIGHT -->
        <div class="space-y-5">

            <!-- PAYMENT -->
            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-semibold mb-3">Pembayaran</h3>

                <p class="text-sm text-gray-400">Metode</p>
                <p>{{ ucfirst($transaction->payment_method) }}</p>

                @if($transaction->payment)

                    <p class="text-sm text-gray-400 mt-2">Bank</p>
                    <p>{{ $transaction->payment->bank_name ?? '-' }}</p>

                    <p class="text-sm text-gray-400">No Rekening</p>
                    <p>{{ $transaction->payment->account_number ?? '-' }}</p>

                    <button 
                        @click="showPayment = true"
                        class="w-full mt-3 bg-blue-500 text-white py-2 rounded text-sm"
                    >
                        Lihat Bukti
                    </button>

                @endif

            </div>



            <!-- TOTAL -->
            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-semibold mb-3">Rincian Harga</h3>

                @foreach($transaction->services as $service)

                    <div class="flex justify-between text-sm">
                        <span>{{ $service->service_name }}</span>
                        <span>{{ $service->formatted_service_price }}</span>
                    </div>

                    @if($service->additional_price)
                    <div class="flex justify-between text-sm">
                        <span>+ {{ $service->additional_service }}</span>
                        <span>{{ $service->formatted_additional_price }}</span>
                    </div>
                    @endif

                @endforeach

                <hr class="my-2">

                <div class="flex justify-between font-semibold text-teal-600">
                    <span>Total</span>
                    <span>{{ $transaction->formatted_total_price }}</span>
                </div>

            </div>

        </div>

    </div>



    <!-- MODAL PAYMENT -->
    <div 
        x-show="showPayment"
        x-cloak
        x-transition
        @click.self="showPayment = false"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    >

        <div class="bg-white p-5 rounded-xl w-[400px]">

            <h3 class="font-semibold mb-3">Bukti Pembayaran</h3>

            <img 
                src="{{ asset('storage/'.$transaction->payment_proof ?? '') }}" 
                class="w-full rounded"
            >

            <button 
                @click="showPayment=false"
                class="mt-4 w-full bg-gray-200 py-2 rounded">
                Tutup
            </button>

        </div>

    </div>



    <!-- MODAL REJECT -->
    <div 
        x-show="showReject"
        x-cloak
        x-transition
        @click.self="showReject = false"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    >

        <div class="bg-white p-5 rounded-xl w-[400px]">

            <h3 class="font-semibold mb-3">Alasan Penolakan</h3>

            <form method="POST" action="{{ route('admin.orders.reject',$transaction->id) }}">
                @csrf

                <textarea
                    name="cancel_reason"
                    class="w-full border rounded p-2 text-sm"
                    placeholder="Masukkan alasan penolakan..."
                    required
                ></textarea>

                <div class="flex gap-2 mt-4">

                    <button class="bg-red-500 text-white w-full py-2 rounded">
                        Tolak
                    </button>

                    <button 
                        type="button"
                        @click="showReject=false"
                        class="bg-gray-200 w-full py-2 rounded">
                        Batal
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection