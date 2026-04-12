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
                    Upload Bukti Pembayaran
                </h2>

                @if($isUploaded)
                <div class="text-blue-600 text-sm">
                    Bukti sudah diupload. Silakan konfirmasi.
                </div>
                @endif

                <form action="{{ route('customer.upload.payment', $order->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="payment_proof"
                        class="w-full border p-2 rounded-xl mb-2">

                    <button class="w-full bg-gray-100 border py-2 rounded-xl hover:bg-gray-200 transition">
                        Upload Bukti
                    </button>
                </form>

                <button onclick="confirmPayment({{ $order->id }})"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl shadow transition">
                    Konfirmasi Pembayaran
                </button>

                <p id="confirm-msg" class="text-sm text-center hidden"></p>

            </div>

            @endif


            {{-- STEP 3 --}}
            @if($isVerified)

            <div class="bg-green-50 border border-green-200 p-4 rounded-2xl text-sm">
                ✅ Pembayaran telah diverifikasi. Menunggu terapis.
            </div>

            @endif

        @endif

    </div>


    <!-- ================= SIDEBAR ================= -->
    <div class="space-y-6">

        <!-- ACTION CARD -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 space-y-4">

            {{-- CANCEL --}}
            @if(!in_array($order->order_status, ['completed','cancelled']))
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


        <!-- DETAIL -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">

            <h3 class="font-semibold mb-3 text-gray-800">Detail</h3>

            <p class="text-sm text-gray-500">{{ $order->transaction_code }}</p>
            <p class="text-sm text-gray-500">{{ $order->customer_address }}</p>
            <p class="text-sm text-gray-500">{{ $order->customer_city }}</p>

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

function confirmPayment(orderId){

    const msg = document.getElementById('confirm-msg');

    msg.innerText = "Mengecek pembayaran...";
    msg.classList.remove('hidden');

    fetch(`/customer/orders/${orderId}/confirm-payment`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {

        msg.innerText = data.message;

        if(data.success){
            setTimeout(()=>location.reload(), 1200);
        }

    });

}

</script>

@endpush