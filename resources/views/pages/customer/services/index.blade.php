@extends('layouts.customer')

@section('content')

<div class="bg-teal-700 text-white p-4">

    <h1 class="text-lg font-semibold">
        Layanan
    </h1>

    <form method="GET" class="mt-3">

        <input
            type="text"
            name="search"
            placeholder="Cari layanan"
            class="w-full px-3 py-2 rounded-md text-black"
        >

    </form>

</div>


<div class="grid grid-cols-2 gap-4 p-4">

@foreach($services as $service)

<div class="bg-white rounded-lg shadow overflow-hidden">

    <img
        src="{{ asset($service->image ?? 'images/service-default.jpg') }}"
        class="w-full h-32 object-cover"
    >

    <div class="p-3">

        <h3 class="text-sm font-semibold">
            {{ $service->name }}
        </h3>

        <p class="text-xs text-gray-500">
            {{ $service->duration }} menit
        </p>

        <div class="flex justify-between items-center mt-2">

            <span class="text-teal-600 font-semibold text-sm">
                Rp {{ number_format($service->price) }}
            </span>

            <button
                onclick="addToCart({{ $service->id }})"
                class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded text-xs">
                +
            </button>

        </div>

    </div>

</div>

@endforeach

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

    let badge = document.getElementById("cart-count");
    const cartIcon = document.querySelector('a[href="{{ route('customer.cart') }}"]');

    if(badge){

        badge.innerText = count;

    }else{

        const span = document.createElement("span");

        span.id = "cart-count";
        span.className = "absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full";

        span.innerText = count;

        cartIcon.appendChild(span);

    }

}


function showToast(message){

    const toast = document.createElement("div");

    toast.className = `
        fixed bottom-6 right-6
        bg-teal-600 text-white
        px-4 py-2 rounded-lg
        shadow-lg
        text-sm
        animate-bounce
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