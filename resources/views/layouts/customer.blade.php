<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Pijetin') }}</title>

    {{-- Tailwind CDN (sementara) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- APP CSS (WAJIB untuk scrollbar) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    {{-- ================= NAVBAR ================= --}}
    @include('layouts.partials.customer.navbar')


    {{-- ================= MAIN CONTENT ================= --}}
    <main class="flex-1 flex flex-col md:pt-0 pb-16 md:pb-0">

        {{-- ===== OPTIONAL HEADER (PER PAGE) ===== --}}
        @hasSection('header')
            <div class="w-full">
                @yield('header')
            </div>
        @endif

        {{-- ===== PAGE CONTENT ===== --}}
        <div class="flex-1 w-full">
            @yield('content')
        </div>

    </main>


    {{-- ================= FOOTER ================= --}}
    <footer class="p-4 text-sm text-center text-gray-500 bg-white border-t">
        © {{ date('Y') }} pijet.in
    </footer>


    {{-- ================= GLOBAL SCRIPT ================= --}}
    <script>
    function showToast(message) {
        const toast = document.createElement('div');
        toast.innerText = message;

        toast.className = `
            fixed top-5 right-5
            bg-black text-white text-sm
            px-4 py-2 rounded-lg shadow-lg
            opacity-0 transition duration-300 z-50
        `;

        document.body.appendChild(toast);

        setTimeout(() => toast.classList.remove('opacity-0'), 100);
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }


    /* ================= CART COUNT ================= */
    async function loadCartCount(){

        try{
            const res = await fetch("/customer/cart/count", {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                cache: "no-store" // 🔥 FIX CACHE
            });

            const data = await res.json();

            const badges = document.querySelectorAll(".cart-count");

            if(!badges.length) return;

            badges.forEach(badge => {
                if(data.count > 0){
                    badge.innerText = data.count;
                    badge.classList.remove("hidden");
                }else{
                    badge.classList.add("hidden");
                }
            });

        }catch(e){
            console.warn("Cart count gagal", e);
        }
    }

    /* ================= GLOBAL ================= */
    window.loadCartCount = loadCartCount;

    /* ================= INIT ================= */
    window.addEventListener("load", loadCartCount);

    /* ================= OPTIONAL REALTIME ================= */
    setInterval(loadCartCount, 5000);

    </script>


    {{-- ================= STACK SCRIPT ================= --}}
    @stack('scripts')

    <!-- ================= MOBILE BOTTOM NAV ================= -->
    <div class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t z-50">

        <div class="grid grid-cols-4 text-xs text-gray-600">

            <a href="{{ route('customer.dashboard') }}"
            class="flex flex-col items-center py-2 {{ request()->routeIs('customer.dashboard') ? 'text-teal-600' : '' }}">
                🏠
                <span>Home</span>
            </a>

            <a href="{{ route('customer.services') }}"
            class="flex flex-col items-center py-2 {{ request()->routeIs('customer.services*') ? 'text-teal-600' : '' }}">
                💆
                <span>Layanan</span>
            </a>

            <a href="{{ route('customer.cart') }}"
            class="flex flex-col items-center py-2">
                🛒
                <span>Keranjang</span>
            </a>

            <a href="{{ route('customer.orders') }}"
            class="flex flex-col items-center py-2">
                📄
                <span>Riwayat</span>
            </a>

        </div>

    </div>

</body>
</html>

