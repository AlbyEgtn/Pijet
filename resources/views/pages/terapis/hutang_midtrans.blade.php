@extends('layouts.terapis')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-teal-100 flex items-center justify-center p-6">

    <div class="w-full max-w-md space-y-6">

        <!-- CARD -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl border border-teal-100 p-6 text-center">

            <div class="mb-4">
                <div class="w-14 h-14 mx-auto rounded-full bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2" />
                    </svg>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800">
                Pembayaran Hutang
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Silakan selesaikan pembayaran melalui QRIS
            </p>

            <!-- NOMINAL -->
            <div class="mt-5">
                <p class="text-xs text-gray-400">Total Tagihan</p>
                <p class="text-3xl font-bold text-teal-700 tracking-wide">
                    Rp {{ number_format($order->company_income,0,',','.') }}
                </p>
            </div>

        </div>

        <!-- BUTTON -->
        <button id="pay-button"
            class="w-full py-3 rounded-2xl font-semibold text-white 
                   bg-gradient-to-r from-teal-600 to-teal-800 
                   hover:from-teal-700 hover:to-teal-900
                   shadow-lg hover:shadow-xl 
                   transition-all duration-300 ease-in-out">
            Bayar Sekarang
        </button>

        <!-- INFO -->
        <p class="text-center text-xs text-gray-400">
            Pembayaran aman melalui Midtrans (QRIS)
        </p>

    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "/terapis/hutang/success/{{ $order->id }}";
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
        },
        onError: function(result){
            alert("Pembayaran gagal");
        }
    });
};
</script>
@endsection