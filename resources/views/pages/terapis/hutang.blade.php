@extends('layouts.terapis')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-cyan-50 flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-2xl">

        <!-- MAIN CARD -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-teal-600 to-emerald-500 px-8 py-8">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl">
                        💳
                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-white">
                            Pembayaran Hutang
                        </h1>

                        <p class="text-teal-100 mt-1">
                            Selesaikan kewajiban pembayaran fee perusahaan
                        </p>

                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-8">

                <!-- ALERT -->
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 mb-8">

                    <div class="flex gap-3">

                        <div class="text-2xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-amber-800">
                                Pembayaran Diperlukan
                            </h3>

                            <p class="text-sm text-amber-700 mt-1 leading-relaxed">
                                Anda masih memiliki kewajiban pembayaran fee perusahaan dari transaksi yang telah selesai.
                                Setelah pembayaran berhasil, seluruh menu dan fitur terapis akan kembali dapat digunakan.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- NOMINAL -->
                <div class="text-center mb-10">

                    <p class="uppercase tracking-wider text-xs text-gray-400">
                        Total Tagihan
                    </p>

                    <div class="mt-3 text-5xl font-extrabold text-teal-600">
                        Rp {{ number_format($order->company_income, 0, ',', '.') }}
                    </div>

                    <div class="mt-3 text-sm text-gray-500">
                        ID Transaksi #{{ $order->id }}
                    </div>

                </div>

                <!-- PAYMENT METHOD -->
                <div>

                    <h3 class="font-semibold text-gray-700 mb-4">
                        Metode Pembayaran
                    </h3>

                    <button
                        id="payButton"
                        onclick="payMidtrans()"
                        class="w-full border-2 border-gray-200 hover:border-teal-500 transition-all duration-300 rounded-2xl p-5 hover:shadow-lg bg-white">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-xl bg-teal-100 flex items-center justify-center text-2xl">
                                    💳
                                </div>

                                <div class="text-left">

                                    <div class="font-semibold text-gray-800">
                                        Midtrans Payment Gateway
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        QRIS • Virtual Account • GoPay • Dana • ShopeePay
                                    </div>

                                </div>

                            </div>

                            <div class="text-teal-600 font-semibold">
                                Bayar →
                            </div>

                        </div>

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

function payMidtrans() {

    const btn = document.getElementById('payButton');

    btn.disabled = true;

    btn.innerHTML = `
        <div class="flex items-center justify-center gap-3">

            <svg
                class="animate-spin h-5 w-5 text-teal-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24">

                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4">
                </circle>

                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8v8z">
                </path>

            </svg>

            <span class="font-medium">
                Memuat pembayaran...
            </span>

        </div>
    `;

    fetch('/terapis/hutang/{{ $order->id }}/snap')

    .then(response => response.json())

    .then(data => {

        snap.pay(data.snap_token, {

            onSuccess: function () {

                window.location.href =
                    '/terapis/hutang/success/{{ $order->id }}';

            },

            onPending: function () {

                alert('Pembayaran sedang menunggu konfirmasi');

                location.reload();

            },

            onError: function () {

                alert('Pembayaran gagal');

                location.reload();

            }

        });

    })

    .catch(error => {

        console.error(error);

        alert('Gagal memuat pembayaran');

        location.reload();

    });

}

</script>

@endsection