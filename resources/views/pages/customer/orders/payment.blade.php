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

<!-- COUNTDOWN -->
<div class="bg-teal-700 text-white rounded-xl p-4 text-center">

    <p class="text-xs opacity-80">
        Waktu pembayaran
    </p>

    <div id="countdown" class="text-2xl font-semibold">
        23 : 59 : 59
    </div>

    <p class="text-xs opacity-80">
        Selesaikan pembayaran sebelum waktu berakhir
    </p>

</div>



<!-- BANK -->
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
        class="mt-3 text-sm bg-gray-100 px-3 py-1 rounded">

        Salin Nomor Rekening

    </button>

</div>



<!-- ORDER INFO -->
<div class="bg-white rounded-xl shadow p-4 space-y-3">

<div class="flex justify-between text-sm">
<span>{{ $order->customer_name }}</span>
<span>ID Pesanan {{ $order->transaction_code }}</span>
</div>

<div class="text-sm text-gray-500">
{{ $order->customer_address }}
</div>

<div class="flex justify-between text-sm">
<span>Tanggal</span>
<span>{{ $order->service_date }}</span>
</div>

<div class="flex justify-between text-sm">
<span>Waktu</span>
<span>{{ $order->service_time }}</span>
</div>

</div>



<!-- LAYANAN -->
<div class="bg-white rounded-xl shadow p-4">

<p class="font-semibold mb-3">
Layanan
</p>

@foreach($order->services as $service)

<div class="flex justify-between text-sm mb-2">

<span>{{ $service->service_name }}</span>

<span>{{ $service->duration }} menit</span>

</div>

@endforeach

</div>



<!-- TOTAL -->
<div class="bg-white rounded-xl shadow p-4">

<div class="flex justify-between font-semibold">

<span>Total Harga</span>

<span class="text-teal-600">
Rp {{ number_format($order->total_price) }}
</span>

</div>

</div>



<!-- UPLOAD -->
<div class="bg-white rounded-xl shadow p-4">

<p class="text-sm text-gray-600 mb-3">
Silakan upload bukti pembayaran
</p>

<input type="file" class="border w-full p-2 rounded">

</div>

</div>

@endsection



@push('scripts')

<script>

/* COPY REK */

function copyRek(){

    const rek = "{{ $order->payment->account_number ?? '' }}";

    if(!rek){

        alert("Nomor rekening belum tersedia");
        return;

    }

    navigator.clipboard.writeText(rek);

    alert("Nomor rekening berhasil disalin");

}



/* COUNTDOWN */

let time = 86400;

setInterval(()=>{

    let h = Math.floor(time/3600);
    let m = Math.floor((time%3600)/60);
    let s = time%60;

    document.getElementById("countdown").innerText =
        `${h} : ${m} : ${s}`;

    time--;

},1000);

</script>

@endpush