@extends('layouts.customer')

@section('content')

<!-- ================= HEADER ================= -->
<div class="bg-gradient-to-r from-teal-700 to-teal-600 text-white p-6">

    <h1 class="text-lg font-semibold">
        Keranjang Saya
        (<span id="cart-count">{{ $carts->count() }}</span>)
    </h1>

</div>


<!-- ================= CART LIST ================= -->
<div class="max-w-4xl mx-auto p-6 space-y-4" id="cart-container">

    @forelse($carts as $cart)

    <div
        class="flex items-center bg-white rounded-xl shadow hover:shadow-md transition p-4 cart-item"
        data-id="{{ $cart->id }}">

        <!-- IMAGE -->
        <img
            src="{{ $cart->service->image_url }}"
            class="w-20 h-20 rounded-lg object-cover"
        >

        <!-- SERVICE INFO -->
        <div class="flex-1 ml-4">

            <h3 class="font-semibold text-sm">
                {{ $cart->service->name }}
            </h3>

            <p class="text-xs text-gray-500 mt-1">
                {{ $cart->service->duration }} menit
            </p>

            <p class="text-teal-600 font-semibold text-sm mt-1">
                Rp {{ number_format($cart->service->price) }}
            </p>

        </div>

        <!-- QTY CONTROL -->
        <div class="flex items-center gap-3">

            <button
                onclick="updateQty({{ $cart->id }},'decrease')"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300">

                −

            </button>

            <span
                id="qty-{{ $cart->id }}"
                class="w-6 text-center font-semibold">

                {{ $cart->qty }}

            </span>

            <button
                onclick="updateQty({{ $cart->id }},'increase')"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-teal-600 text-white hover:bg-teal-700">

                +

            </button>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">
        Keranjang masih kosong.
    </div>

    @endforelse

</div>


<!-- ================= CHECKOUT BAR ================= -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg">

    <div class="max-w-4xl mx-auto flex items-center justify-between p-4">

        <div>

            <p class="text-xs text-gray-500">
                Total Pembayaran
            </p>

            <p
                class="font-semibold text-lg text-teal-700"
                id="cart-total">

                Rp {{ number_format($total) }}

            </p>

        </div>

        <button
            onclick="openCheckoutSheet()"
            class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg shadow">

            Pesan Sekarang

        </button>

    </div>

</div>


<!-- ================= CHECKOUT SHEET ================= -->
<div
    id="checkoutSheet"
    class="fixed inset-0 bg-black/40 hidden z-50">

    <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl max-w-xl mx-auto max-h-[90vh] overflow-y-auto p-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-4">

            <button
                onclick="closeCheckoutSheet()"
                class="text-gray-500 text-xl">

                ←

            </button>

            <h2 class="font-semibold text-lg">
                Detail Layanan
            </h2>

            <span></span>

        </div>


        <!-- SERVICE INFO -->
        <div class="flex flex-col items-center text-center">

            <img
                src="{{ $carts->first()?->service->image_url ?? '' }}"
                class="w-40 rounded-lg mb-4">

            <p class="font-semibold">
                {{ $carts->first()?->service->name ?? '' }}
            </p>

        </div>


        <!-- DURASI -->
        <div class="mt-6">

            <label class="text-sm font-semibold">
                Durasi Pijat
            </label>

            <select
                id="duration"
                class="w-full border rounded-lg px-3 py-2 mt-2">

                <option value="60">60 menit</option>
                <option value="90">90 menit</option>
                <option value="120">120 menit</option>

            </select>

        </div>


        <!-- GENDER TERAPIS -->
        <div class="mt-6">

            <p class="text-sm font-semibold">
                Pilih Gender Terapis
            </p>

            <div class="flex gap-6 mt-2">

                <label class="flex items-center gap-2">

                    <input
                        type="radio"
                        name="therapist_gender"
                        value="male">

                    Laki-laki

                </label>

                <label class="flex items-center gap-2">

                    <input
                        type="radio"
                        name="therapist_gender"
                        value="female">

                    Perempuan

                </label>

            </div>

        </div>


        <!-- ADDITIONAL SERVICES -->
        <div class="mt-6">

            <p class="text-sm font-semibold">
                Layanan Tambahan
            </p>

            @foreach($additionalServices as $add)

            <label class="flex justify-between items-start border rounded-lg p-3 mt-3 cursor-pointer">

                <div>

                    <input
                        type="checkbox"
                        class="additional"
                        value="{{ $add->price }}">

                    <p class="font-semibold text-sm">
                        {{ $add->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ $add->description }}
                    </p>

                </div>

                <span class="text-sm text-gray-600">
                    Rp {{ number_format($add->price) }}
                </span>

            </label>

            @endforeach

        </div>


        <!-- JADWAL -->
        <div class="mt-6">

            <p class="text-sm font-semibold">
                Jadwal Layanan
            </p>

            <div class="grid grid-cols-2 gap-3 mt-2">

                <input
                    type="date"
                    id="service_date"
                    class="border rounded-lg px-3 py-2">

                <input
                    type="time"
                    id="service_time"
                    class="border rounded-lg px-3 py-2">

            </div>

        </div>


        <!-- METODE PEMBAYARAN -->
        <div class="mt-6">

            <p class="text-sm font-semibold">
                Metode Pembayaran
            </p>

            <div class="space-y-2 mt-2">

                <label class="flex justify-between border rounded-lg p-3">

                    Cash

                    <input
                        type="radio"
                        name="payment_method"
                        value="cash"
                        checked>

                </label>

                <label class="flex justify-between border rounded-lg p-3">

                    Transfer

                    <input
                        type="radio"
                        name="payment_method"
                        value="transfer">

                </label>

            </div>

        </div>

        <!-- ================= INFO REKENING ================= -->
        <div id="transferInfo" class="mt-4 hidden">

            <p class="text-sm font-semibold mb-2">
                Informasi Rekening
            </p>

            @foreach($payments as $pay)
            <div class="border rounded-lg p-3 mb-2 bg-gray-50">

                <p class="text-sm font-semibold">
                    {{ $pay->bank_name }}
                </p>

                <p class="text-sm">
                    No Rek: {{ $pay->account_number }}
                </p>

                <p class="text-xs text-gray-500">
                    a.n {{ $pay->account_holder }}
                </p>

            </div>
            @endforeach

        </div>


        <!-- TOTAL -->
        <div class="mt-6 bg-gray-100 rounded-lg p-4 flex justify-between items-center">

            <div>

                <p class="text-xs text-gray-500">
                    Total Pembayaran
                </p>

                <p
                    id="checkoutTotal"
                    class="font-semibold text-teal-700 text-lg">

                    Rp {{ number_format($total) }}

                </p>

            </div>

            <button
                onclick="confirmCheckout()"
                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg">

                Pesan Sekarang

            </button>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

/* ================= UPDATE QTY ================= */

function updateQty(cartId,type){

    fetch(`/customer/cart/${type}/${cartId}`,{
        method:"GET",
        headers:{
            "X-Requested-With":"XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            if(data.qty <= 0){

                document.querySelector(`[data-id="${cartId}"]`).remove();

            }else{

                document.getElementById(`qty-${cartId}`).innerText = data.qty;

            }

            document.getElementById("cart-total").innerText = "Rp " + data.total;
            document.getElementById("cart-count").innerText = data.count;

        }

    })
    .catch(err => {

        console.error(err);
        showToast("Gagal memperbarui keranjang");

    });

}


/* ================= CHECKOUT SHEET ================= */

function openCheckoutSheet(){

    document
        .getElementById("checkoutSheet")
        .classList
        .remove("hidden");

}

function closeCheckoutSheet(){

    document
        .getElementById("checkoutSheet")
        .classList
        .add("hidden");

}

/* ================= PAYMENT TOGGLE ================= */

document.querySelectorAll('input[name="payment_method"]').forEach(el => {

    el.addEventListener("change", function(){

        const transferBox = document.getElementById("transferInfo");

        if(this.value === "transfer"){

            transferBox.classList.remove("hidden");

        }else{

            transferBox.classList.add("hidden");

        }

    });

});


/* ================= TOTAL ADDITIONAL ================= */

const basePrice = {{ $total }};

document.querySelectorAll(".additional").forEach(el => {

    el.addEventListener("change", updateTotal);

});

function updateTotal(){

    let total = basePrice;

    document.querySelectorAll(".additional:checked").forEach(add => {

        total += parseInt(add.value);

    });

    document.getElementById("checkoutTotal").innerText =
        "Rp " + total.toLocaleString();

}


/* ================= USER DATA ================= */

const userPhone = @json(auth()->user()->phone);
const userCity = @json(auth()->user()->city);
const userAddress = @json(auth()->user()->address);


/* ================= CHECKOUT ================= */

function confirmCheckout(){

    const payment =
        document.querySelector(
            'input[name="payment_method"]:checked'
        ).value;

    const date =
        document.getElementById("service_date").value;

    const time =
        document.getElementById("service_time").value;

    const phone = @json(auth()->user()->phone);
    const city = @json(auth()->user()->city);
    const address = @json(auth()->user()->address);

    if(!date || !time){

        showToast("Silakan pilih jadwal layanan");
        return;

    }

    const formData = new FormData();

    formData.append('payment_method', payment);
    formData.append('service_date', date);
    formData.append('service_time', time);

    formData.append('phone', phone);
    formData.append('city', city);
    formData.append('address', address);

    fetch("{{ route('customer.cart.checkout') }}",{

        method:"POST",

        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}",
            "X-Requested-With":"XMLHttpRequest"
        },

        body: formData

    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            showToast("Pesanan anda sedang diproses");

            setTimeout(()=>{

                window.location.href = data.redirect;

            },1500);

        }else{

            showToast(data.message ?? "Checkout gagal");

        }

    })
    .catch(err => {

        console.error(err);
        showToast("Terjadi kesalahan sistem");

    });

}




/* ================= TOAST ================= */

function showToast(message){

    const toast = document.createElement("div");

    toast.className = `
        fixed bottom-6 right-6
        bg-teal-600 text-white
        px-4 py-2 rounded-lg
        shadow-lg
        text-sm
        z-50
    `;

    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(()=>{

        toast.remove();

    },2500);

}

</script>

@endpush

