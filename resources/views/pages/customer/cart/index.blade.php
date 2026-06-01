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


<div class="max-w-4xl mx-auto px-4 md:px-6 py-6 space-y-4">

@forelse($carts as $cart)

    <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-4 flex items-center gap-4">

        <!-- CHECKBOX -->
        <input type="checkbox"
               class="cart-check accent-teal-600 flex-shrink-0"
               data-id="{{ $cart->id }}"
               data-price="{{ $cart->service->price }}"
               onchange="updateSelectedTotal()">

        <!-- IMAGE -->
        <img src="{{ $cart->service->image_url }}"
             class="w-20 h-20 rounded-xl object-cover flex-shrink-0">

        <!-- CONTENT -->
        <div class="flex-1 min-w-0">

            <h3 class="font-semibold text-gray-800 text-sm truncate">
                {{ $cart->service->name }}
            </h3>

            <p class="text-xs text-gray-400 mt-1">
                ⏱ {{ $cart->service->duration }} menit
            </p>

            <p class="text-teal-600 font-semibold text-sm mt-2">
                Rp {{ number_format($cart->service->price) }}
            </p>

        </div>

        <!-- ACTION -->
        <div class="flex flex-col items-end gap-2 flex-shrink-0">

            <!-- QTY -->
            <div class="flex items-center gap-2 bg-gray-100 rounded-lg px-2 py-1">

                <button onclick="updateQty({{ $cart->id }},'decrease')"
                    class="w-6 h-6 flex items-center justify-center text-gray-600 hover:bg-gray-200 rounded">
                    -
                </button>

                <span id="qty-{{ $cart->id }}"
                      class="text-sm font-medium w-5 text-center">
                    {{ $cart->qty }}
                </span>

                <button onclick="updateQty({{ $cart->id }},'increase')"
                    class="w-6 h-6 flex items-center justify-center text-white bg-teal-600 rounded">
                    +
                </button>

            </div>

            <!-- DELETE -->
            <button onclick="deleteCart({{ $cart->id }})"
                class="text-xs text-red-500 hover:underline">
                Hapus
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
<div class="fixed bottom-16 md:bottom-0 left-0 right-0 bg-white border-t shadow-lg">

    <div class="max-w-4xl mx-auto flex justify-between items-center px-6 py-4">

        <div>
            <p class="text-xs text-gray-400">Total</p>
            <p id="cart-total" class="font-semibold text-teal-700 text-lg">
                Rp 0
            </p>
        </div>

        <button onclick="openCheckout()"
            class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl shadow-md transition font-medium">
            Pesan Sekarang
        </button>

    </div>

</div>


<!-- ================= CHECKOUT MODAL ================= -->
<div id="checkoutSheet"
    class="fixed inset-0 bg-black/50 hidden z-50 backdrop-blur-sm">

    <div class="flex items-end md:items-center justify-center h-screen pb-16 md:pb-0">

        <!-- MODAL -->
        <div class="
            bg-white w-full md:max-w-2xl
            rounded-t-3xl md:rounded-2xl
            shadow-2xl
            animate-fadeIn
            max-h-[92vh]
            flex flex-col
        ">

            <!-- HANDLE MOBILE -->
            <div class="md:hidden flex justify-center pt-3">
                <div class="w-14 h-1.5 rounded-full bg-gray-300"></div>
            </div>

            <!-- HEADER -->
            <div class="flex justify-between items-center px-4 py-4 border-b">

                <h2 class="font-semibold text-lg text-gray-800">
                    Checkout
                </h2>

                <button onclick="closeCheckout()"
                    class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-500">
                    ✕
                </button>

            </div>


            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto">

                <!-- LIST LAYANAN -->
                <div class="px-4 py-4 space-y-3" id="checkoutItems">
                    <!-- isi via JS -->
                </div>

                <!-- FORM -->
                <div class="px-4 pb-5 space-y-4">

                    <!-- DATE TIME -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        <div class="relative">
                            <input type="date"
                                id="service_date"
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>

                        <div class="relative">
                            <input type="time"
                                id="service_time"
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>

                    </div>


                    <!-- PAYMENT -->
                    <div class="space-y-3">

                        <label class="
                            flex items-center justify-between
                            border rounded-2xl px-4 py-4
                            cursor-pointer
                            hover:border-teal-500
                            transition
                        ">

                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    Cash
                                </p>

                                <p class="text-xs text-gray-400">
                                    Bayar langsung ditempat
                                </p>
                            </div>

                            <input type="radio"
                                name="payment_method"
                                value="cash"
                                class="w-4 h-4 accent-teal-600">

                        </label>


                        <label class="
                            flex items-center justify-between
                            border rounded-2xl px-4 py-4
                            cursor-pointer
                            hover:border-teal-500
                            transition
                        ">

                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    Transfer
                                </p>

                                <p class="text-xs text-gray-400">
                                    Pembayaran online
                                </p>
                            </div>

                            <input type="radio"
                                name="payment_method"
                                value="transfer"
                                class="w-4 h-4 accent-teal-600">

                        </label>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->
            <div class="
                border-t bg-white
                px-4 py-4
                sticky bottom-0
                z-50
                shadow-[0_-4px_12px_rgba(0,0,0,0.06)]
                pb-[calc(1rem+env(safe-area-inset-bottom))]
            ">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-xs text-gray-400">
                            Total Bayar
                        </p>

                        <p id="checkoutTotal"
                            class="text-xl font-bold text-teal-700 truncate">
                            Rp 0
                        </p>

                    </div>

                    <button onclick="confirmCheckout()"
                        class="
                            bg-teal-600 hover:bg-teal-700
                            active:scale-95
                            transition
                            text-white
                            px-6 py-3
                            rounded-2xl
                            text-sm font-medium
                            whitespace-nowrap
                            shadow-md
                        ">

                        Checkout

                    </button>

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

    const checked = document.querySelectorAll(".cart-check:checked");

    if(checked.length === 0){
        showToast("Pilih layanan terlebih dahulu", "error");
        return;
    }

    document.getElementById('checkoutSheet').classList.remove('hidden');

    renderCheckoutItems(); // 🔥 tampilkan list
    updateTotal();         // 🔥 hitung total
}

function closeCheckout(){
    document.getElementById('checkoutSheet').classList.add('hidden');
}

function renderCheckoutItems(){

    const container = document.getElementById("checkoutItems");
    container.innerHTML = "";

    document.querySelectorAll(".cart-check:checked").forEach(el => {

        const id    = el.dataset.id;
        const price = parseInt(el.dataset.price);
        const qty   = parseInt(document.getElementById("qty-" + id).innerText);

        const name  = el.closest('.bg-white')
                        .querySelector('h3')
                        .innerText;

        const item = `
            <div class="flex justify-between items-center border rounded-xl p-3">

                <div>
                    <p class="text-sm font-medium text-gray-800">${name}</p>
                    <p class="text-xs text-gray-400">${qty}x</p>
                </div>

                <p class="text-sm font-semibold text-teal-600">
                    Rp ${(price * qty).toLocaleString()}
                </p>

            </div>
        `;

        container.innerHTML += item;

    });

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

function getSelectedTotal(){

    let total = 0;

    document.querySelectorAll(".cart-check:checked").forEach(el => {

        const id    = el.dataset.id;
        const price = parseInt(el.dataset.price);
        const qty   = parseInt(document.getElementById("qty-" + id).innerText);

        total += price * qty;

    });

    return total;
}

document.querySelectorAll(".additional").forEach(el => {
    el.addEventListener("change", updateTotal);
});

function updateTotal(){

    let total = 0;

    document.querySelectorAll(".cart-check:checked").forEach(el => {

        const id    = el.dataset.id;
        const price = parseInt(el.dataset.price);
        const qty   = parseInt(document.getElementById("qty-" + id).innerText);

        total += price * qty;

    });

    document.querySelectorAll(".additional:checked").forEach(el => {
        total += parseInt(el.value);
    });

    document.getElementById("checkoutTotal").innerText =
        "Rp " + total.toLocaleString();
}


/* ================= CHECKOUT ================= */

function confirmCheckout(){

    const checked = document.querySelectorAll(".cart-check:checked");

    if(checked.length === 0){
        showToast("Tidak ada layanan yang dipilih", "error");
        return;
    }

    const btn = event.target;

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

    // 🔥 kirim ID yang dicentang
    checked.forEach(el => {
        formData.append("cart_ids[]", el.dataset.id);
    });

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

            // 🔥 JIKA ADA MIDTRANS
            if(data.snap_token){

                window.snap.pay(data.snap_token, {

                    onSuccess: function(){
                        showToast("Pembayaran berhasil");
                        window.location.href = data.redirect;
                    },

                    onPending: function(){
                        showToast("Menunggu pembayaran");
                        window.location.href = data.redirect;
                    },

                    onError: function(){
                        showToast("Pembayaran gagal", "error");
                        resetButton(btn);
                    }

                });

            }else{
                // 🔥 CASH FLOW
                showToast("Pesanan dibuat");

                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 800);
            }

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

/* ================= SCROLL FIX ================= */
document.body.style.overflow = "auto";


/* ================= TOTAL BERDASARKAN CHECKBOX ================= */
function updateSelectedTotal(){

    let total = 0;

    document.querySelectorAll(".cart-check:checked").forEach(el => {

        const price = parseInt(el.dataset.price);
        const qty   = parseInt(document.getElementById("qty-" + el.dataset.id).innerText);

        total += price * qty;

    });

    document.getElementById("cart-total").innerText =
        "Rp " + total.toLocaleString();
}


/* ================= UPDATE QTY ================= */
function updateQty(cartId, action){

    fetch(`/customer/cart/update/${cartId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({ action })
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            document.getElementById(`qty-${cartId}`).innerText = data.qty;

            updateSelectedTotal();

            // ✅ TAMBAH INI
            loadCartCount();
            renderCheckoutItems();
            updateTotal();

        }

    });
}


/* ================= DELETE CART ================= */
function deleteCart(cartId){

    if(!confirm("Hapus layanan ini?")) return;

    fetch(`/customer/cart/delete/${cartId}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            // hapus element dari DOM
            const el = document.querySelector(`[data-id="${cartId}"]`)?.closest('.bg-white');
            if(el) el.remove();

            updateSelectedTotal();

            // ✅ UPDATE BADGE
            loadCartCount();
            renderCheckoutItems();
            updateTotal();
        }

    });
}


/* ================= RESET BUTTON ================= */

function resetButton(btn){
    btn.disabled = false;
    btn.innerText = "Buat Pesanan";
}

</script>
@endpush