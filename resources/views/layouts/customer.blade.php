<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    @include('layouts.partials.customer.navbar')

    <main class="p-6">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('scripts')

</body>
<script>

function updateCartCount(){

    fetch("/customer/cart/count")
    .then(res => res.json())
    .then(data => {

        const badge = document.getElementById("cart-count");
        const cartIcon = document.querySelector('a[href="{{ route('customer.cart') }}"]');

        if(badge){

            badge.innerText = data.count;

        }else if(data.count > 0){

            const span = document.createElement("span");

            span.id = "cart-count";
            span.className = "absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full";
            span.innerText = data.count;

            cartIcon.appendChild(span);

        }

    });

}

</script>

</html>