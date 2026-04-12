@extends('layouts.customer')

@section('title','Layanan')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[300px] md:h-[340px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <!-- dekor blur -->
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-emerald-300 rounded-full blur-3xl opacity-30"></div>
    <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-teal-300 rounded-full blur-3xl opacity-30"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex flex-col justify-center text-white">

        <h1 class="text-3xl md:text-4xl font-semibold">
            Pilih Layanan Terbaik
        </h1>

        <p class="text-sm opacity-90 mt-2">
            Terapis profesional siap melayani Anda
        </p>

        <!-- SEARCH -->
        <form method="GET" class="mt-5 max-w-md">
            <input
                type="text"
                name="search"
                placeholder="🔍 Cari layanan..."
                value="{{ request('search') }}"
                class="w-full px-4 py-2 rounded-xl text-black shadow focus:outline-none"
            >
        </form>

    </div>

</section>


<!-- ================= CONTENT ================= -->
<div class="max-w-7xl mx-auto px-6 py-10 space-y-14">

<!-- ================= LAYANAN UTAMA ================= -->
<section>

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Layanan Utama
            </h2>
            <p class="text-xs text-gray-400">
                Pilihan terbaik untuk relaksasi Anda
            </p>
        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach($services as $service)

        <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition overflow-hidden">

            <!-- IMAGE -->
            <div class="relative aspect-[4/3] overflow-hidden">
                <img src="{{ $service->image_url }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                <!-- overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <!-- CONTENT -->
            <div class="p-4 space-y-2">

                <h3 class="font-semibold text-sm text-gray-800 line-clamp-1">
                    {{ $service->name }}
                </h3>

                <p class="text-xs text-gray-400">
                    ⏱ {{ $service->duration }} menit
                </p>

                <div class="flex items-center justify-between mt-3">

                    <span class="text-teal-600 font-semibold text-sm">
                        Rp {{ number_format($service->price,0,',','.') }}
                    </span>

                    <button
                        onclick="addToCart({{ $service->id }})"
                        class="bg-teal-600 hover:bg-teal-700 active:scale-90 text-white
                               w-9 h-9 rounded-full flex items-center justify-center
                               shadow-md transition">

                        +

                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>


<!-- ================= LAYANAN TAMBAHAN ================= -->
<section>

    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Layanan Tambahan
    </h2>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach($additionalServices as $service)

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition p-4 flex gap-4 items-center">

            <img src="{{ $service->image_url }}"
                 class="w-16 h-16 rounded-xl object-cover flex-shrink-0">

            <div class="flex-1 space-y-1">

                <p class="font-semibold text-sm text-gray-800 line-clamp-1">
                    {{ $service->name }}
                </p>

                <p class="text-xs text-gray-400 line-clamp-2">
                    {{ $service->description }}
                </p>

                <p class="text-teal-600 font-semibold text-sm">
                    Rp {{ number_format($service->price,0,',','.') }}
                </p>

            </div>

            <button
                onclick="addToCart({{ $service->id }})"
                class="bg-teal-600 hover:bg-teal-700 active:scale-95 text-white
                       px-4 py-2 rounded-lg text-xs shadow transition">

                Tambah

            </button>

        </div>

        @endforeach

    </div>

</section>

</div>

@endsection


@push('scripts')

<script>

/* ===============================
   GLOBAL STATE
================================ */
let isAdding = false;


/* ===============================
   ADD TO CART (TIDAK DIUBAH LOGIC)
================================ */
async function addToCart(id){

    if(isAdding) return;
    isAdding = true;

    try{

        const res = await fetch(`/customer/cart/add/${id}`,{
            method:"GET",
            headers:{
                "X-Requested-With":"XMLHttpRequest",
                "Accept":"application/json"
            }
        });

        const data = await res.json();

        if(data.success){
            updateCartBadge(data.count);
            showToast("Ditambahkan ke keranjang");
        }else{
            showToast("Gagal menambahkan", true);
        }

    }catch(e){
        console.error(e);
        showToast("Error sistem", true);
    }

    isAdding = false;
}


/* ===============================
   BADGE UPDATE (TIDAK DIUBAH)
================================ */
function updateCartBadge(count){

    const badge = document.getElementById("cart-count");

    if(!badge) return;

    if(count <= 0){
        badge.classList.add("hidden");
        return;
    }

    badge.innerText = count;
    badge.classList.remove("hidden");

    badge.classList.add("scale-125");
    setTimeout(()=> badge.classList.remove("scale-125"), 200);
}


/* ===============================
   TOAST (UPGRADE VISUAL SAJA)
================================ */
function showToast(message, isError=false){

    const toast = document.createElement("div");

    toast.className = `
        fixed bottom-6 right-6
        px-4 py-2 rounded-xl
        text-sm text-white shadow-xl z-50
        transition-all duration-300
        ${isError ? 'bg-red-500' : 'bg-teal-600'}
    `;

    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(()=>{
        toast.style.opacity = "0";
        toast.style.transform = "translateY(10px)";
        setTimeout(()=> toast.remove(), 300);
    },2000);
}


/* ===============================
   INIT BADGE
================================ */
document.addEventListener("DOMContentLoaded", async () => {

    try{
        const res = await fetch("/customer/cart/count",{
            headers:{
                "X-Requested-With":"XMLHttpRequest"
            }
        });

        const data = await res.json();

        if(data.count){
            updateCartBadge(data.count);
        }

    }catch(e){
        console.warn("Cart load gagal");
    }

});

</script>

@endpush