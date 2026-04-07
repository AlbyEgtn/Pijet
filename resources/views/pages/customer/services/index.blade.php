@extends('layouts.customer')

@section('title','Layanan  ')

@section('content')

<!-- HEADER -->
<div class="bg-gradient-to-r from-teal-700 to-teal-600 text-white p-6">

    <h1 class="text-xl font-semibold">
        Layanan
    </h1>

    <form method="GET" class="mt-3">

        <input
            type="text"
            name="search"
            placeholder="Cari layanan..."
            value="{{ request('search') }}"
            class="w-full px-4 py-2 rounded-lg text-black focus:outline-none"
        >

    </form>

</div>


<div class="max-w-7xl mx-auto p-6 space-y-10">

<!-- ======================
    LAYANAN UTAMA
====================== -->

<section>

    <h2 class="text-lg font-semibold mb-5">
        Layanan Utama
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($services as $service)

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden group">

            <div class="aspect-[4/3] overflow-hidden">

                <img
                    src="{{ $service->image_url }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                >

            </div>

            <div class="p-4">

                <h3 class="font-semibold text-sm line-clamp-1">
                    {{ $service->name }}
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    {{ $service->duration }} menit
                </p>

                <div class="flex justify-between items-center mt-3">

                    <span class="text-teal-600 font-semibold text-sm">
                        Rp {{ number_format($service->price) }}
                    </span>

                    <button
                        onclick="addToCart({{ $service->id }})"
                        class="bg-teal-600 hover:bg-teal-700 text-white w-8 h-8 rounded-full flex items-center justify-center text-lg">

                        +

                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>


<!-- ======================
    LAYANAN TAMBAHAN
====================== -->

<section>

    <h2 class="text-lg font-semibold mb-5">
        Add-on / Layanan Tambahan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        @foreach($additionalServices as $service)

        <div class="bg-white rounded-xl shadow hover:shadow-md transition p-4 flex items-center gap-4">

            <img
                src="{{ $service->image_url }}"
                class="w-16 h-16 rounded-lg object-cover"
            >

            <div class="flex-1">

                <p class="font-semibold text-sm">
                    {{ $service->name }}
                </p>

                <p class="text-xs text-gray-500">
                    {{ $service->description }}
                </p>

            </div>

            <div class="text-right">

                <p class="text-teal-600 font-semibold text-sm">
                    Rp {{ number_format($service->price) }}
                </p>

                <button
                    onclick="addToCart({{ $service->id }})"
                    class="mt-1 text-xs bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded">

                    Tambah

                </button>

            </div>

        </div>

        @endforeach

    </div>

</section>

</div>

@endsection


@push('scripts')

<script>

function addToCart(id){

    fetch(`/customer/cart/add/${id}`,{
        method:"GET",
        headers:{
            "X-Requested-With":"XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            updateCartBadge(data.count);
            showToast("Layanan berhasil masuk ke keranjang");

        }

    });

}

function updateCartBadge(count){

    const cartIcon = document.querySelector('a[href="{{ route('customer.cart') }}"]');

    if(!cartIcon) return;

    let badge = document.getElementById("cart-count");

    if(!badge){
        badge = document.createElement("span");

        badge.id = "cart-count";
        badge.className = "absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full";

        cartIcon.appendChild(badge);
    }

    badge.innerText = count;
}

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

