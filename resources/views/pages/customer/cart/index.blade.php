@extends('layouts.customer')

@section('content')

<div class="bg-teal-700 text-white p-4">

    <h1 class="font-semibold">
        Keranjang Saya (<span id="cart-count">{{ $carts->count() }}</span>)
    </h1>

</div>


<div class="p-4 space-y-4" id="cart-container">

@foreach($carts as $cart)

<div class="flex items-center bg-white rounded-lg shadow p-3 cart-item" data-id="{{ $cart->id }}">

    <img
        src="{{ asset($cart->service->image) }}"
        class="w-16 h-16 rounded object-cover mr-3"
    >

    <div class="flex-1">

        <h3 class="text-sm font-semibold">
            {{ $cart->service->name }}
        </h3>

        <p class="text-xs text-gray-500">
            Rp{{ number_format($cart->service->price) }}
        </p>

    </div>


    <div class="flex items-center gap-2">

        <button
            onclick="updateQty({{ $cart->id }},'decrease')"
            class="px-2 bg-gray-200 rounded">
            -
        </button>

        <span id="qty-{{ $cart->id }}">
            {{ $cart->qty }}
        </span>

        <button
            onclick="updateQty({{ $cart->id }},'increase')"
            class="px-2 bg-gray-200 rounded">
            +
        </button>

    </div>

</div>

@endforeach

</div>


<div class="fixed bottom-0 w-full bg-white shadow p-4 flex justify-between items-center">

    <span class="font-semibold text-teal-700" id="cart-total">
        Rp {{ number_format($total) }}
    </span>

    <button class="bg-teal-600 text-white px-4 py-2 rounded">
        Pesan Sekarang
    </button>

</div>

@endsection


@push('scripts')

<script>

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

    });

}

</script>

@endpush