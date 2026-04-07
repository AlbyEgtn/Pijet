@extends('layouts.customer')

@section('title','Pembayaran  ')
@section('header','Pembayaran ')

@section('content')

<!-- ================= HEADER ================= -->
<div class="bg-gradient-to-r from-teal-700 to-teal-500 text-white p-5 shadow-md flex items-center gap-4">
    <a href="{{ route('customer.orders') }}" class="text-xl">←</a>
    <div>
        <h1 class="font-semibold text-lg">Pembayaran</h1>
        <p class="text-xs opacity-80">Selesaikan pembayaran pesanan</p>
    </div>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
<div class="max-w-7xl mx-auto px-6 pt-4">
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
        {{ session('success') }}
    </div>
</div>
@endif

<div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ================= LEFT ================= -->
    <div class="lg:col-span-2 space-y-6">

        {{-- ================= COUNTDOWN ================= --}}
        {{-- Countdown hanya tampil jika transfer DAN tidak ada therapist_id --}}
        @if($order->payment_method === 'transfer' && (!isset($order->therapist_id) || !$order->therapist_id))
        <div class="bg-teal-600 text-white text-center rounded-2xl p-5 shadow">
            <p class="text-xs opacity-80">Sisa Waktu Pembayaran</p>
            <p id="countdown" class="text-3xl font-bold">00:00:00</p>
            <p class="text-xs opacity-80">Selesaikan sebelum waktu habis</p>
        </div>
        @endif

        {{-- ================= CASH INFO ================= --}}
        @if($order->payment_method === 'cash' || (isset($order->therapist_id) && $order->therapist_id))
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 text-sm text-yellow-700">
            Pembayaran dilakukan saat therapist datang ke lokasi.
            Harap menyiapkan uang sesuai total tagihan.
        </div>
        @endif

        {{-- ================= BANK INFO ================= --}}
        @if($order->payment_method === 'transfer' && (!isset($order->therapist_id) || !$order->therapist_id))
        <div class="bg-white rounded-2xl shadow p-5 space-y-4">

            <h2 class="font-semibold">Transfer Bank</h2>

            @if($order->companyAccount)
            <div class="bg-gray-50 p-4 rounded-lg text-sm space-y-1">
                <p><b>Bank:</b> {{ $order->companyAccount->bank_name }}</p>
                <p><b>No. Rekening:</b> {{ $order->companyAccount->account_number }}</p>
                <p><b>Atas Nama:</b> {{ $order->companyAccount->account_holder }}</p>
            </div>

            <button
                onclick="navigator.clipboard.writeText('{{ $order->companyAccount->account_number }}').then(() => alert('Nomor rekening berhasil disalin'))"
                class="text-sm bg-gray-100 px-3 py-1 rounded-lg">
                Salin Nomor Rekening
            </button>
            @else
            <p class="text-sm text-red-500">Rekening tujuan tidak ditemukan.</p>
            @endif

            @if($order->payment_status === 'uploaded')
            <p class="text-xs text-green-600">
                Bukti sudah diupload, menunggu verifikasi admin
            </p>
            @endif

        </div>
        @endif

        {{-- ================= UPLOAD ================= --}}
        {{-- Upload hanya tampil jika transfer DAN tidak ada therapist_id --}}
        @if($order->payment_method === 'transfer' && (!isset($order->therapist_id) || !$order->therapist_id))
        <div class="bg-white rounded-2xl shadow p-5">

            <p class="text-sm text-gray-600 mb-3">
                Upload bukti pembayaran
            </p>

            <form action="{{ route('customer.upload.payment',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" id="payment_proof" name="payment_proof" class="w-full border p-2 rounded-lg" accept="image/*">

                <button type="submit" class="mt-4 w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition">
                    Upload Bukti Pembayaran
                </button>

            </form>

        </div>
        @endif


    </div>

    <!-- ================= RIGHT ================= -->
    <div class="space-y-6">

        {{-- DETAIL --}}
        <div class="bg-white rounded-2xl shadow p-4 space-y-3">
            <h2 class="font-semibold">Detail Pesanan</h2>
            <div class="text-sm text-gray-600">
                <p>{{ $order->customer_name }}</p>
                <p>{{ $order->customer_address }}</p>
                <p>{{ $order->customer_city }}</p>
                <p>{{ \Carbon\Carbon::parse($order->service_date)->format('d-m-Y') }} • {{ $order->service_time }}</p>
            </div>
        </div>

        {{-- SERVICES --}}
        <div class="bg-white rounded-2xl shadow p-4">
            <h2 class="font-semibold mb-3">Layanan</h2>
            @foreach($order->services as $service)
            <div class="flex justify-between text-sm mb-2">
                <span>{{ $service->service_name }}</span>
                <span class="text-gray-500">{{ $service->duration }} menit</span>
            </div>
            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
            <span>Total</span>
            <span class="text-teal-600">Rp {{ number_format($order->total_price) }}</span>
        </div>

        {{-- ================= BUKTI ================= --}}
        {{-- Bukti pembayaran hanya tampil jika tidak ada therapist_id --}}
        @if($order->payment_proof && (!isset($order->therapist_id) || !$order->therapist_id))
        <div class="bg-white rounded-2xl shadow p-5">

            <p class="text-sm mb-2">Bukti pembayaran saat ini</p>

            <img src="{{ asset('storage/'.$order->payment_proof) }}"
                 class="rounded-lg border max-h-64 object-contain mx-auto">

            <p class="text-xs text-gray-500 mt-2 text-center">
                Jika salah, silakan upload ulang
            </p>

        </div>
        @endif

    </div>

</div>

@endsection


@push('scripts')
<script>

/* ================= AUTO REFRESH STATUS ================= */
setInterval(function(){

    fetch("{{ url('customer/order/status/'.$order->id) }}")
    .then(res => res.json())
    .then(data => {

        if(data.payment_status === 'verified'){
            window.location.href = "/customer/orders/" + data.id;
        }

    });

}, 5000);


/* ================= SELECT REKENING ================= */
{{-- Hanya jalankan jika tidak ada therapist_id --}}
@if(!isset($order->therapist_id) || !$order->therapist_id)

let selectedRek = "";

document.addEventListener("DOMContentLoaded", function(){

    const select = document.getElementById("rekeningSelect");
    if(!select) return;

    select.addEventListener("change", function(){

        const selected = this.options[this.selectedIndex];
        const detail = document.getElementById("rekeningDetail");

        if(!selected.value){
            detail.classList.add("hidden");
            return;
        }

        document.getElementById("rekBank").innerText   = selected.dataset.bank;
        document.getElementById("rekNumber").innerText = selected.dataset.number;
        document.getElementById("rekHolder").innerText = selected.dataset.holder;

        selectedRek = selected.dataset.number;
        detail.classList.remove("hidden");

    });

});


/* ================= COPY ================= */
function copyRek(){

    if(!selectedRek){
        alert("Pilih rekening dulu");
        return;
    }

    navigator.clipboard.writeText(selectedRek);
    alert("Nomor rekening berhasil disalin");

}

@endif


/* ================= COUNTDOWN ================= */
{{-- Countdown hanya jalan jika transfer DAN tidak ada therapist_id --}}
@if($order->payment_method === 'transfer' && (!isset($order->therapist_id) || !$order->therapist_id))

@if($order->payment_expired_at)
const expiredTimestamp =
    {{ \Carbon\Carbon::parse($order->payment_expired_at)->timestamp * 1000 }};
@else
const expiredTimestamp = Date.now() + (24 * 60 * 60 * 1000);
@endif

function updateCountdown(){

    const now      = Date.now();
    const distance = expiredTimestamp - now;
    const el       = document.getElementById("countdown");

    if(!el) return;

    if(distance <= 0){
        el.innerText = "Waktu habis";
        return;
    }

    const h = Math.floor(distance / 3600000);
    const m = Math.floor((distance % 3600000) / 60000);
    const s = Math.floor((distance % 60000) / 1000);

    el.innerText =
        String(h).padStart(2,'0') + ":" +
        String(m).padStart(2,'0') + ":" +
        String(s).padStart(2,'0');

}

updateCountdown();
setInterval(updateCountdown, 1000);

@endif


/* ================= IMAGE PREVIEW ================= */
{{-- Preview hanya jalan jika tidak ada therapist_id --}}
@if(!isset($order->therapist_id) || !$order->therapist_id)

const inputFile = document.getElementById("payment_proof");

if(inputFile){

    inputFile.addEventListener("change", function(){

        const file = this.files[0];
        if(!file) return;

        const reader = new FileReader();

        reader.onload = function(e){

            let preview = document.getElementById("previewImage");

            if(!preview){
                preview           = document.createElement("img");
                preview.id        = "previewImage";
                preview.className = "mt-3 rounded-lg border max-h-48 mx-auto";
                inputFile.parentNode.appendChild(preview);
            }

            preview.src = e.target.result;

        };

        reader.readAsDataURL(file);

    });

}

@endif

</script>
@endpush