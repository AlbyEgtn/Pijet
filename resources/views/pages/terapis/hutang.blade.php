@extends('layouts.terapis')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-teal-50 to-white flex items-center justify-center p-6">

    <div class="w-full max-w-xl space-y-6">

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow p-6 text-center">

            <h2 class="text-lg font-semibold">Bayar Hutang</h2>

            <p class="text-sm text-gray-500">
                Pilih metode pembayaran
            </p>

            <div class="mt-4 text-3xl font-bold text-teal-600">
                Rp {{ number_format($order->company_income) }}
            </div>

        </div>


        <!-- ================= METHOD ================= -->
        <div class="bg-white rounded-2xl shadow p-6 space-y-4">

            <!-- MIDTRANS -->
            <button onclick="payMidtrans()"
                class="w-full border p-4 rounded-xl text-left hover:bg-gray-50">
                💳 Midtrans (QRIS / VA / E-Wallet)
            </button>

        </div>

    </div>

</div>


<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
function payMidtrans(){

    fetch(`/terapis/hutang/{{ $order->id }}/snap`)
    .then(res => res.json())
    .then(data => {

        snap.pay(data.snap_token, {
            onSuccess: function(){
                window.location.href = "/terapis/hutang/success/{{ $order->id }}";
            },
            onPending: function(){
                alert("Menunggu pembayaran");
            },
            onError: function(){
                alert("Gagal bayar");
            }
        });

    });

}
</script>

@endsection