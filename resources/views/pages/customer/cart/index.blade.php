@extends('layouts.customer')

@section('title','Keranjang')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 h-full flex items-center text-white">

        <div>
            <h1 class="text-2xl font-semibold">
                Keranjang Saya
            </h1>

            <p class="text-sm opacity-90">
                {{ $carts->count() }} layanan dipilih
            </p>
        </div>

    </div>

</section>


<!-- ================= CART LIST ================= -->
<div class="max-w-4xl mx-auto px-6 py-10 space-y-5">

    @forelse($carts as $cart)

    <div class="flex items-center bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-4">

        <img src="{{ $cart->service->image_url }}"
             class="w-20 h-20 rounded-xl object-cover">

        <div class="flex-1 ml-4 space-y-1">

            <h3 class="font-semibold text-sm text-gray-800">
                {{ $cart->service->name }}
            </h3>

            <p class="text-xs text-gray-400">
                ⏱ {{ $cart->service->duration }} menit
            </p>

            <p class="text-teal-600 font-semibold text-sm">
                Rp {{ number_format($cart->service->price) }}
            </p>

        </div>

        <!-- QTY CONTROL (TIDAK DIUBAH) -->
        <div class="flex items-center gap-2">

            <button onclick="updateQty({{ $cart->id }},'decrease')"
                class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg hover:bg-gray-300">
                -
            </button>

            <span id="qty-{{ $cart->id }}" class="text-sm font-medium w-6 text-center">
                {{ $cart->qty }}
            </span>

            <button onclick="updateQty({{ $cart->id }},'increase')"
                class="w-8 h-8 flex items-center justify-center bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                +
            </button>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">
        Keranjang kosong
    </div>

    @endforelse

</div>


<!-- ================= CHECKOUT BAR ================= -->
<div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur border-t shadow-lg">

    <div class="max-w-4xl mx-auto flex justify-between items-center px-6 py-4">

        <div>
            <p class="text-xs text-gray-400">Total</p>
            <p id="cart-total" class="font-semibold text-teal-700 text-lg">
                Rp {{ number_format($total) }}
            </p>
        </div>

        <button onclick="openCheckout()"
            class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl shadow-md transition font-medium">
            Pesan Sekarang
        </button>

    </div>

</div>


<!-- ================= CHECKOUT MODAL ================= -->
<div id="checkoutSheet" class="fixed inset-0 bg-black/50 hidden z-50 backdrop-blur-sm">

    <div class="flex items-center justify-center min-h-screen p-6">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl p-8">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-semibold">
                    Detail Pesanan
                </h2>

                <button onclick="closeCheckout()"
                    class="text-gray-500 text-xl hover:text-gray-700">
                    ✕
                </button>

            </div>


            <div class="grid md:grid-cols-2 gap-8">

                <!-- ================= LEFT ================= -->
                <div>

                    <!-- SERVICE -->
                    <div class="flex items-center gap-4 mb-6">

                        <img src="{{ $carts->first()?->service->image_url ?? '' }}"
                             class="w-24 h-24 rounded-xl object-cover">

                        <div>
                            <p class="font-semibold text-lg">
                                {{ $carts->first()?->service->name ?? '' }}
                            </p>
                            <p class="text-sm text-gray-400">
                                {{ $carts->first()?->service->duration ?? '' }} menit
                            </p>
                        </div>

                    </div>


                    <!-- DURASI -->
                    <div class="mb-5">

                        <label class="text-sm font-semibold">Durasi</label>

                        <select id="duration"
                            class="w-full border rounded-xl px-3 py-2 mt-2 focus:ring-2 focus:ring-teal-500">

                            <option value="60">60 menit</option>
                            <option value="90">90 menit</option>
                            <option value="120">120 menit</option>

                        </select>

                    </div>


                    <!-- GENDER -->
                    <div class="mb-5">

                        <label class="text-sm font-semibold">Gender Terapis</label>

                        <div class="flex gap-6 mt-2">

                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="therapist_gender" value="male">
                                Laki-laki
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="therapist_gender" value="female">
                                Perempuan
                            </label>

                        </div>

                    </div>


                    <!-- ADDITIONAL -->
                    <div>

                        <label class="text-sm font-semibold">Layanan Tambahan</label>

                        <div class="space-y-2 mt-2 max-h-40 overflow-y-auto">

                            @foreach($additionalServices as $add)

                            <label class="flex justify-between border rounded-xl p-3 cursor-pointer hover:bg-gray-50">

                                <div>
                                    <input type="checkbox"
                                           class="additional"
                                           value="{{ $add->price }}">

                                    <span class="ml-2 text-sm font-medium">
                                        {{ $add->name }}
                                    </span>
                                </div>

                                <span class="text-sm text-gray-500">
                                    Rp {{ number_format($add->price) }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                    </div>

                </div>


                <!-- ================= RIGHT ================= -->
                <div>

                    <!-- JADWAL -->
                    <div class="mb-6">

                        <label class="text-sm font-semibold">Jadwal</label>

                        <div class="grid grid-cols-2 gap-3 mt-2">

                            <input type="date" id="service_date"
                                class="border rounded-xl px-3 py-2">

                            <input type="time" id="service_time"
                                class="border rounded-xl px-3 py-2">

                        </div>

                    </div>


                    <!-- PAYMENT -->
                    <div class="mb-6">

                        <label class="text-sm font-semibold">Metode Pembayaran</label>

                        <div class="space-y-3 mt-3">

                            <label class="flex justify-between items-center border rounded-xl p-3 cursor-pointer hover:bg-gray-50">
                                <span>Cash (Bayar di tempat)</span>
                                <input type="radio" name="payment_method" value="cash">
                            </label>

                            <label class="flex justify-between items-center border rounded-xl p-3 cursor-pointer hover:bg-gray-50">
                                <span>Transfer</span>
                                <input type="radio" name="payment_method" value="transfer">
                            </label>

                        </div>

                    </div>


                    <!-- TOTAL -->
                    <div class="bg-gray-100 rounded-xl p-5">

                        <div class="flex justify-between mb-4">

                            <span class="text-gray-500">Total</span>

                            <span id="checkoutTotal"
                                  class="font-semibold text-lg text-teal-700">
                                Rp {{ number_format($total) }}
                            </span>

                        </div>

                        <button onclick="confirmCheckout()"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl font-semibold transition">
                            Buat Pesanan
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

/* ================= MODAL CONTROL ================= */

function openCheckout(){
    document.getElementById('checkoutSheet').classList.remove('hidden');
}

function closeCheckout(){
    document.getElementById('checkoutSheet').classList.add('hidden');
}


/* ================= HELPER ================= */

function showToast(message, type = 'success'){

    const colors = {
        success: 'bg-teal-600',
        error: 'bg-red-500'
    };

    const toast = document.createElement("div");

    toast.className = `
        fixed bottom-6 right-6
        ${colors[type]}
        text-white px-4 py-2
        rounded-lg shadow-lg text-sm z-50
    `;

    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 2500);
}


/* ================= TOTAL CALCULATION ================= */

const baseTotal = {{ $total }};

document.querySelectorAll(".additional").forEach(el => {
    el.addEventListener("change", updateTotal);
});

function updateTotal(){

    let total = baseTotal;

    document.querySelectorAll(".additional:checked").forEach(el => {
        total += parseInt(el.value);
    });

    document.getElementById("checkoutTotal").innerText =
        "Rp " + total.toLocaleString();
}


/* ================= CHECKOUT ================= */

function confirmCheckout(){

    const btn = event.target;

    // 🔒 prevent double click
    btn.disabled = true;
    btn.innerText = "Memproses...";

    const payment = document.querySelector('input[name="payment_method"]:checked')?.value;
    const date    = document.getElementById("service_date").value;
    const time    = document.getElementById("service_time").value;

    if(!payment){
        showToast("Pilih metode pembayaran", "error");
        resetButton(btn);
        return;
    }

    if(!date || !time){
        showToast("Lengkapi jadwal layanan", "error");
        resetButton(btn);
        return;
    }

    const formData = new FormData();
    formData.append("payment_method", payment);
    formData.append("service_date", date);
    formData.append("service_time", time);

    fetch("{{ route('customer.cart.checkout') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            showToast("Pesanan dibuat");

            setTimeout(() => {
                window.location.href = data.redirect;
            }, 800);

        }else{
            showToast(data.message || "Checkout gagal", "error");
            resetButton(btn);
        }

    })
    .catch(err => {
        console.error(err);
        showToast("Terjadi kesalahan sistem", "error");
        resetButton(btn);
    });

}


/* ================= RESET BUTTON ================= */

function resetButton(btn){
    btn.disabled = false;
    btn.innerText = "Buat Pesanan";
}

</script>
@endpush