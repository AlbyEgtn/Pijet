@extends('layouts.customer')

@section('content')

<div class="bg-teal-700 text-white p-4 flex items-center gap-3">

    <a href="{{ route('customer.orders') }}">
        ←
    </a>

    <h1 class="font-semibold">
        Pembayaran
    </h1>

</div>



<div class="max-w-xl mx-auto p-4 space-y-4">

    <!-- CUSTOMER -->
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold">
            {{ $order->customer_name }}
        </p>

        <p class="text-xs text-gray-500">
            ID Pesanan {{ $order->transaction_code }}
        </p>

    </div>



    <!-- ADDRESS -->
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold mb-2">
            Alamat Utama
        </p>

        <p class="text-sm text-gray-600">
            {{ $order->customer_address }}
        </p>

        <p class="text-sm text-gray-500">
            {{ $order->customer_city }}
        </p>

    </div>



    <!-- JADWAL -->
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold mb-3">
            Jadwal
        </p>

        <div class="flex justify-between text-sm">

            <span class="text-gray-500">
                Tanggal
            </span>

            <span>
                {{ \Carbon\Carbon::parse($order->service_date)->format('d-m-Y') }}
            </span>

        </div>

        <div class="flex justify-between text-sm mt-2">

            <span class="text-gray-500">
                Waktu
            </span>

            <span>
                {{ $order->service_time }}
            </span>

        </div>

    </div>



    <!-- LAYANAN -->
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold mb-3">
            Layanan
        </p>

        @foreach($order->services as $service)

        <div class="border rounded-lg p-3 mb-3">

            <div class="flex justify-between text-sm">

                <span>
                    {{ $service->service_name }}
                </span>

                <span class="text-gray-500">
                    {{ $service->duration }} menit
                </span>

            </div>

        </div>

        @endforeach

    </div>



    <!-- TOTAL -->
    <div class="bg-white rounded-xl shadow p-4">

        <div class="flex justify-between font-semibold">

            <span>
                Total Harga
            </span>

            <span class="text-teal-600">
                Rp {{ number_format($order->total_price) }}
            </span>

        </div>

    </div>



    <!-- METODE PEMBAYARAN -->
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold mb-3">
            Metode Pembayaran
        </p>

        <div class="space-y-2">

            <label class="flex justify-between border rounded-lg p-3 cursor-pointer">

                Cash

                <input
                    type="radio"
                    name="payment_method"
                    value="cash"
                    checked
                    onchange="toggleBank()">

            </label>

            <label class="flex justify-between border rounded-lg p-3 cursor-pointer">

                Transfer

                <input
                    type="radio"
                    name="payment_method"
                    value="transfer"
                    onchange="toggleBank()">

            </label>

        </div>



        <!-- BANK LIST -->
        <div id="bankList" class="hidden mt-4">

            <select
                id="bank"
                class="w-full border rounded-lg px-3 py-2">

                <option value="">
                    Pilih Bank
                </option>

                <option value="BCA">
                    BCA Bank Transfer
                </option>

                <option value="BRI">
                    BRI Bank Transfer
                </option>

                <option value="BNI">
                    BNI Bank Transfer
                </option>

                <option value="MANDIRI">
                    Mandiri Bank Transfer
                </option>

            </select>

        </div>

    </div>



    <!-- BUTTON -->
    <div class="flex gap-3">

        <a
            href="{{ route('customer.orders') }}"
            class="flex-1 border text-center py-2 rounded-lg">

            Batal

        </a>

        <button
            onclick="processPayment({{ $order->id }})"
            class="flex-1 bg-teal-600 text-white py-2 rounded-lg">

            Selanjutnya

        </button>

    </div>

</div>

@endsection



@push('scripts')

<script>

/* ================= SHOW BANK ================= */

function toggleBank(){

    const method =
        document.querySelector(
            'input[name="payment_method"]:checked'
        ).value;

    const bankList =
        document.getElementById("bankList");

    if(method === "transfer"){

        bankList.classList.remove("hidden");

    }else{

        bankList.classList.add("hidden");

    }

}



/* ================= PROCESS PAYMENT ================= */

function processPayment(orderId){

    const method =
        document.querySelector(
            'input[name="payment_method"]:checked'
        ).value;

    const bank =
        document.getElementById("bank")?.value ?? null;


    if(method === "transfer" && !bank){

        alert("Silakan pilih bank terlebih dahulu");
        return;

    }


    fetch(`/customer/orders/${orderId}/payment`,{

        method:"POST",

        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":"{{ csrf_token() }}",
            "X-Requested-With":"XMLHttpRequest"
        },

        body: JSON.stringify({

            payment_method: method,
            bank: bank

        })

    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            window.location.href = data.redirect;

        }

    });

}

</script>

@endpush