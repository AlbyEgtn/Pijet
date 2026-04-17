@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex items-center gap-4 text-white">

        <a href="{{ route('customer.orders') }}"
           class="text-xl bg-white/20 p-2 rounded-full hover:bg-white/30 transition">
            ←
        </a>

        <div>
            <h1 class="text-2xl font-semibold">
                Detail Pesanan
            </h1>
            <p class="text-sm opacity-90">
                Monitoring status & pembayaran
            </p>
        </div>

    </div>

</section>


@php
    $isPending   = $order->payment_status === 'pending';
    $isUploaded  = $order->payment_status === 'uploaded';
    $isVerified  = $order->payment_status === 'verified';
@endphp


<div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ================= MAIN ================= -->
    <div class="lg:col-span-2 space-y-6">

        <!-- STATUS CARD -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 border-l-4
            {{ $isVerified ? 'border-green-500' : ($isPending ? 'border-yellow-400' : 'border-blue-400') }}">

            <p class="text-xs text-gray-400">Status</p>

            <p class="font-semibold text-lg text-gray-800 mt-1">

                @if($order->payment_method === 'cash')
                    💰 Pembayaran di Tempat
                @elseif($isPending)
                    ⏳ Menunggu Pembayaran
                @elseif($isUploaded)
                    📤 Menunggu Verifikasi
                @elseif($isVerified)
                    ✅ Pembayaran Berhasil
                @endif

            </p>

        </div>


        <!-- ================= PAYMENT ================= -->

        {{-- CASH --}}
        @if($order->payment_method === 'cash')

        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-2xl text-sm">
            💰 Pembayaran dilakukan langsung ke terapis saat layanan selesai.
        </div>

        @endif


        {{-- TRANSFER --}}
        @if($order->payment_method === 'transfer')

            {{-- STEP 1 --}}
            @if($isPending)

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 space-y-4">

                <h2 class="font-semibold text-gray-800">
                    Pembayaran Transfer
                </h2>

                <button onclick="payNow('{{ $order->id }}')"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl shadow transition font-medium">
                    💳 Bayar Sekarang
                </button>

            </div>

            @endif


            {{-- STEP 2 --}}
            @if($isPending || $isUploaded)

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 space-y-4">

                <h2 class="font-semibold text-gray-800">
                    Status Pembayaran
                </h2>

                {{-- ================= PENDING ================= --}}
                @if($isPending)

                    <p class="text-sm text-gray-500">
                        Silakan upload bukti pembayaran setelah melakukan transfer.
                    </p>

                    <form action="{{ route('customer.upload.payment', $order->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="payment_proof"
                            class="w-full border p-2 rounded-xl mb-2">

                        <button class="w-full bg-gray-100 border py-2 rounded-xl hover:bg-gray-200 transition">
                            Upload Bukti
                        </button>
                    </form>

                @endif


                {{-- ================= UPLOADED (TRACKING) ================= --}}
                @if($isUploaded)

                    <div class="flex items-center gap-3">

                        <!-- STEP ICON -->
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 text-lg">
                            ⏳
                        </div>

                        <!-- TEXT -->
                        <div>
                            <p class="font-medium text-gray-800">
                                Menunggu Verifikasi Admin
                            </p>
                            <p class="text-sm text-gray-500">
                                Bukti pembayaran sudah diterima dan sedang diperiksa.
                            </p>
                        </div>

                    </div>

                    {{-- OPTIONAL: progress bar --}}
                    <div class="w-full bg-gray-100 rounded-full h-2 mt-2">
                        <div class="bg-blue-500 h-2 rounded-full w-2/3 animate-pulse"></div>
                    </div>

                @endif

                <p id="confirm-msg" class="text-sm text-center hidden"></p>

            </div>

            @endif


            {{-- STEP 3 --}}
            @if($isVerified)

            <div class="bg-green-50 border border-green-200 p-4 rounded-2xl text-sm">
                Pembayaran telah diverifikasi. Menunggu terapis.
            </div>

            @endif

            @php
                $orderSteps = [
                    'waiting' => 1,
                    'ready' => 2,
                    'assigned' => 3,
                    'on_the_way' => 4,
                    'ongoing' => 5,
                    'completed' => 6,
                ];

                $currentStep = $orderSteps[$order->order_status] ?? 0;
            @endphp

            @php
                if ($order->payment_status !== 'verified') {
                    $currentStep = 1; // stuck di awal
                }
            @endphp

            <!-- ================= ORDER TRACKING ================= -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h2 class="font-semibold text-gray-800 mb-4">
                    Tracking Pesanan
                </h2>

                <div class="space-y-4">

                    {{-- STEP 1 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 1 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            1
                        </div>
                        <p class="{{ $currentStep >= 1 ? 'text-gray-800' : 'text-gray-400' }}">
                            Menunggu Pembayaran
                        </p>
                    </div>

                    {{-- STEP 2 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 2 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            2
                        </div>
                        <p class="{{ $currentStep >= 2 ? 'text-gray-800' : 'text-gray-400' }}">
                            Terapis Siap
                        </p>
                    </div>

                    {{-- STEP 3 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 3 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            3
                        </div>
                        <p class="{{ $currentStep >= 3 ? 'text-gray-800' : 'text-gray-400' }}">
                            Terapis Ditugaskan
                        </p>
                    </div>

                    {{-- STEP 4 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 4 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            4
                        </div>
                        <p class="{{ $currentStep >= 4 ? 'text-gray-800' : 'text-gray-400' }}">
                            Terapis Menuju Lokasi
                        </p>
                    </div>

                    {{-- STEP 5 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 5 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            5
                        </div>
                        <p class="{{ $currentStep >= 5 ? 'text-gray-800' : 'text-gray-400' }}">
                            Sedang Berlangsung
                        </p>
                    </div>

                    {{-- STEP 6 --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentStep >= 6 ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            6
                        </div>
                        <p class="{{ $currentStep >= 6 ? 'text-gray-800' : 'text-gray-400' }}">
                            Selesai
                        </p>
                    </div>

                    {{-- CANCELLED --}}
                    @if($order->order_status === 'cancelled')
                    <div class="flex items-center gap-3 text-red-500">
                        ❌ Pesanan Dibatalkan
                    </div>
                    @endif

                </div>

            </div>

        @endif

    </div>



    <!-- ================= SIDEBAR ================= -->
    <div class="space-y-6">

        <!-- ACTION CARD -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 space-y-4">

            {{-- CANCEL --}}
            @if(
                !in_array($order->order_status, ['completed','cancelled']) 
                && $order->payment_status !== 'verified'
            )
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                @csrf

                <textarea name="cancel_reason"
                    class="w-full border p-2 rounded-xl mb-2"
                    placeholder="Alasan pembatalan..."
                    required></textarea>

                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl transition">
                    Batalkan Pesanan
                </button>
            </form>
            @endif


            {{-- RESCHEDULE --}}
            @if(in_array($order->order_status, ['waiting','ready','assigned']))
            <form action="{{ route('customer.orders.reschedule', $order->id) }}" method="POST">
                @csrf

                <input type="date" name="new_date"
                    class="w-full border p-2 rounded-xl mb-2" required>

                <input type="time" name="new_time"
                    class="w-full border p-2 rounded-xl mb-2" required>

                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
                    Reschedule
                </button>
            </form>
            @endif

        </div>


        <!-- ================= DETAIL ORDER (ENHANCED) ================= -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 space-y-4">

            <h3 class="font-semibold text-gray-800">Detail Pesanan</h3>

            <!-- KODE -->
            <div class="text-sm">
                <p class="text-gray-400">Kode Transaksi</p>
                <p class="font-medium text-gray-800">{{ $order->transaction_code }}</p>
            </div>

            <!-- STATUS -->
            <div class="text-sm">
                <p class="text-gray-400">Status Pesanan</p>
                <p class="font-medium">
                    {{ strtoupper($order->order_status) }}
                </p>
            </div>

            <!-- PAYMENT -->
            <div class="text-sm">
                <p class="text-gray-400">Status Pembayaran</p>
                <p class="font-medium">
                    {{ strtoupper($order->payment_status) }}
                </p>
            </div>

            <!-- METODE -->
            <div class="text-sm">
                <p class="text-gray-400">Metode Pembayaran</p>
                <p class="font-medium">
                    {{ $order->payment_method ?? '-' }}
                </p>
            </div>

            <!-- ALAMAT -->
            <div class="text-sm">
                <p class="text-gray-400">Lokasi</p>
                <p class="text-gray-700">
                    {{ $order->customer_address }}
                </p>
                <p class="text-gray-500 text-xs">
                    {{ $order->customer_city }}
                </p>
            </div>

            <!-- JADWAL -->
            <div class="text-sm">
                <p class="text-gray-400">Jadwal Layanan</p>
                <p class="font-medium text-gray-800">
                    {{ $order->service_date ?? '-' }} • {{ $order->service_time ?? '-' }}
                </p>
            </div>

            <!-- RESCHEDULE -->
            @if($order->order_status === 'rescheduled')
            <div class="text-sm bg-blue-50 p-3 rounded-xl border border-blue-200">
                <p class="text-blue-600 font-medium">🔄 Dijadwalkan Ulang</p>
                <p class="text-blue-500 text-xs">
                    {{ $order->reschedule_date }} • {{ $order->reschedule_time }}
                </p>
            </div>
            @endif

            <!-- CANCEL -->
            @if($order->order_status === 'cancelled')
            <div class="text-sm bg-red-50 p-3 rounded-xl border border-red-200">
                <p class="text-red-600 font-medium">❌ Pesanan Dibatalkan</p>
                <p class="text-red-500 text-xs">
                    {{ $order->cancel_reason }}
                </p>
            </div>
            @endif

        </div>


        <!-- TOTAL -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">

            <p class="font-semibold text-gray-800">Total</p>

            <p class="text-teal-600 font-semibold text-lg">
                Rp {{ number_format($order->total_price) }}
            </p>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>

/* ================= MIDTRANS ================= */

function payNow(orderId){

    fetch(`/customer/orders/${orderId}/snap-token`)
    .then(async res => {
        const data = await res.json();

        if(!res.ok){
            console.error(data);
            alert(data.error || "Gagal ambil token");
            return null;
        }

        return data;
    })
    .then(data => {

        if(!data) return;

        if(!data.snap_token){
            alert("Snap token kosong");
            return;
        }

        console.log("SNAP TOKEN:", data.snap_token);

        snap.pay(data.snap_token, {
            onSuccess: () => location.reload(),
            onPending: () => alert("Menunggu pembayaran"),
            onError:   () => alert("Pembayaran gagal")
        });

    })
    .catch(err => {
        console.error(err);
        alert("Error sistem");
    });

}


/* ================= CONFIRM PAYMENT ================= */
function checkPaymentStatus(orderId){

    fetch(`/customer/orders/${orderId}/status`)
    .then(res => res.json())
    .then(data => {

        console.log("STATUS:", data);

        if(data.payment_status === 'verified'){
            location.reload(); // auto update UI
        }

    })
    .catch(err => console.error(err));
}

let countdown = 5;
const el = document.getElementById("confirm-msg");

const timer = setInterval(() => {
    el.innerText = `Memverifikasi dalam ${countdown} detik...`;
    countdown--;

    if (countdown < 0) {
        clearInterval(timer);
    }
}, 1000);

document.addEventListener("DOMContentLoaded", function(){

    const orderId = {{ $order->id }};
    let interval;

    // ⏱️ DELAY 5 DETIK
    setTimeout(() => {

        interval = setInterval(() => {

            fetch(`/customer/orders/${orderId}/status`)
            .then(res => res.json())
            .then(data => {

                console.log("CHECK:", data);

                // 🔥 STOP POLLING SAJA
                if (
                    data.order_status === 'ready' ||
                    data.payment_status === 'verified'
                ) {
                    clearInterval(interval);

                    // OPTIONAL: ubah text UI
                    el.innerText = "Pembayaran berhasil diverifikasi ✅";

                }

            })
            .catch(err => console.error(err));

        }, 3000);

    }, 5000);

});

</script>

@endpush