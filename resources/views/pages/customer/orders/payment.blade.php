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



{{-- SUCCESS MESSAGE --}}
@if(session('success'))

<div class="max-w-xl mx-auto p-4">

    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>

</div>

@endif



<div class="max-w-xl mx-auto p-4 space-y-4">

    {{-- ================= COUNTDOWN ================= --}}
    @if($order->payment_method === 'transfer')

    <div class="bg-teal-700 text-white rounded-xl p-4 text-center">

        <p class="text-xs opacity-80">
            Waktu pembayaran
        </p>

        <div id="countdown" class="text-2xl font-semibold">
            00 : 00 : 00
        </div>

        <p class="text-xs opacity-80">
            Selesaikan pembayaran sebelum waktu berakhir
        </p>

    </div>

    @endif



    {{-- ================= CASH INFO ================= --}}
    @if($order->payment_method === 'cash')

    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-700">

        Pembayaran dilakukan saat therapist datang ke lokasi.
        Harap menyiapkan uang sesuai dengan total tagihan.

    </div>

    @endif



    {{-- ================= BANK INFO ================= --}}
    @if($order->payment_method === 'transfer')

    <div class="bg-white rounded-xl shadow p-4">

        <p class="text-sm text-gray-500 mb-2">
            Transfer ke rekening berikut
        </p>

        <div class="space-y-2">

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Bank
                </span>

                <span class="font-semibold">
                    {{ $order->payment->bank_name ?? '-' }}
                </span>

            </div>

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    No Rekening
                </span>

                <span class="font-semibold">
                    {{ $order->payment->account_number ?? '-' }}
                </span>

            </div>

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Atas Nama
                </span>

                <span class="font-semibold">
                    {{ $order->payment->account_holder ?? '-' }}
                </span>

            </div>

        </div>

        <button
            onclick="copyRek()"
            class="mt-3 text-sm bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 transition"
        >
            Salin Nomor Rekening
        </button>

    </div>

    @endif



    {{-- ================= ORDER INFO ================= --}}
    <div class="bg-white rounded-xl shadow p-4 space-y-3">

        <div class="flex justify-between text-sm">

            <span>
                {{ $order->customer_name }}
            </span>

            <span class="text-gray-500">
                ID Pesanan {{ $order->transaction_code }}
            </span>

        </div>

        <div class="text-sm text-gray-500">
            {{ $order->customer_address }}
        </div>

        <div class="flex justify-between text-sm">

            <span class="text-gray-500">
                Kota
            </span>

            <span>
                {{ $order->customer_city }}
            </span>

        </div>

        <div class="flex justify-between text-sm">

            <span class="text-gray-500">
                Tanggal
            </span>

            <span>
                {{ \Carbon\Carbon::parse($order->service_date)->format('d-m-Y') }}
            </span>

        </div>

        <div class="flex justify-between text-sm">

            <span class="text-gray-500">
                Waktu
            </span>

            <span>
                {{ $order->service_time }}
            </span>

        </div>

    </div>



    {{-- ================= SERVICES ================= --}}
    <div class="bg-white rounded-xl shadow p-4">

        <p class="font-semibold mb-3">
            Layanan
        </p>

        @foreach($order->services as $service)

        <div class="flex justify-between text-sm mb-2">

            <span>
                {{ $service->service_name }}
            </span>

            <span class="text-gray-500">
                {{ $service->duration }} menit
            </span>

        </div>

        @endforeach

    </div>



    {{-- ================= TOTAL ================= --}}
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



    {{-- ================= UPLOAD BUKTI ================= --}}
    @if($order->payment_method === 'transfer')

    <div class="bg-white rounded-xl shadow p-4">

        <p class="text-sm text-gray-600 mb-3">
            Upload bukti pembayaran
        </p>

        <form
            action="{{ route('customer.upload.payment',$order->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

        @csrf

            <input
                type="file"
                name="payment_proof"
                id="payment_proof"
                class="border w-full p-2 rounded"
                accept="image/*"
            >

            <button
                type="submit"
                class="mt-4 w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition"
            >
                Upload Bukti Pembayaran
            </button>

        </form>

    </div>

    @endif



    {{-- ================= BUKTI PEMBAYARAN ================= --}}
    @if($order->payment_proof)

    <div class="bg-white rounded-xl shadow p-4">

        <p class="text-sm mb-2">
            Bukti pembayaran saat ini
        </p>

        <img
            src="{{ asset('storage/'.$order->payment_proof) }}"
            class="rounded-lg border max-h-64 object-contain mx-auto"
        >

        <p class="text-xs text-gray-500 mt-2 text-center">
            Jika bukti salah, silakan upload ulang.
        </p>

    </div>

    @endif

</div>

@endsection



@push('scripts')

<script>

/* ================= COPY REKENING ================= */

function copyRek(){

    const rek = "{{ $order->payment->account_number ?? '' }}";

    if(!rek){

        alert("Nomor rekening belum tersedia");
        return;

    }

    navigator.clipboard.writeText(rek);

    alert("Nomor rekening berhasil disalin");

}



/* ================= COUNTDOWN ================= */

@if($order->payment_method === 'transfer')

const expiredTimestamp =
    {{ \Carbon\Carbon::parse($order->payment_expired_at)->timestamp * 1000 }};

function updateCountdown(){

    const now = Date.now();

    const distance = expiredTimestamp - now;

    const el = document.getElementById("countdown");

    if(distance <= 0){

        el.innerText = "Waktu habis";
        return;

    }

    const hours =
        Math.floor(distance / (1000 * 60 * 60));

    const minutes =
        Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    const seconds =
        Math.floor((distance % (1000 * 60)) / 1000);

    el.innerText =
        String(hours).padStart(2,'0') + " : " +
        String(minutes).padStart(2,'0') + " : " +
        String(seconds).padStart(2,'0');

}

updateCountdown();

setInterval(updateCountdown,1000);

@endif



/* ================= IMAGE PREVIEW ================= */

const inputFile = document.getElementById("payment_proof");

if(inputFile){

    inputFile.addEventListener("change", function(){

        const file = this.files[0];

        if(!file) return;

        const reader = new FileReader();

        reader.onload = function(e){

            const previewContainer =
                document.getElementById("previewContainer");

            const previewImage =
                document.getElementById("previewImage");

            previewImage.src = e.target.result;

            previewContainer.classList.remove("hidden");

        };

        reader.readAsDataURL(file);

    });

}

</script>

@endpush