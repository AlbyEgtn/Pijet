<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-pth.png') }}">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- APP CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

    <style>

        [x-cloak]{
            display:none !important;
        }

        @keyframes fadeInUp {

            from{
                transform: translateY(30px);
                opacity:0;
            }

            to{
                transform: translateY(0);
                opacity:1;
            }

        }

        .animate-fadeIn{
            animation: fadeInUp .25s ease;
        }

    </style>

</head>

<body class="
    min-h-screen
    flex flex-col
    bg-[#F6F8F7]
    text-gray-800
">

    <!-- ================= NAVBAR ================= -->
    @include('layouts.partials.customer.navbar')



    <!-- ================= MAIN ================= -->
    <main class="
        flex-1
        flex flex-col
        pb-24 md:pb-0
    ">

        <!-- OPTIONAL HEADER -->
        @hasSection('header')

            <div class="w-full">
                @yield('header')
            </div>

        @endif


        <!-- CONTENT -->
        <div class="
            flex-1
            w-full
        ">

            @yield('content')

        </div>

    </main>



    <!-- ================= FOOTER ================= -->
    <footer class="
        hidden md:block
        bg-white
        border-t border-gray-100
        py-5
        px-6
        text-center
        text-sm
        text-gray-500
    ">

        © {{ date('Y') }} pijet.in

    </footer>



    <!-- ================= GLOBAL SCRIPT ================= -->
    <script>

        /* ================= TOAST ================= */
        function showToast(message, type = 'default') {

            const toast = document.createElement('div');

            toast.innerText = message;

            let bgClass = 'bg-gray-900';

            if(type === 'success'){
                bgClass = 'bg-teal-600';
            }

            if(type === 'error'){
                bgClass = 'bg-red-500';
            }

            toast.className = `
                fixed top-5 right-5
                ${bgClass}
                text-white text-sm font-medium
                px-5 py-3
                rounded-2xl
                shadow-2xl
                opacity-0
                translate-y-2
                transition-all duration-300
                z-[9999]
            `;

            document.body.appendChild(toast);

            setTimeout(() => {

                toast.classList.remove('opacity-0','translate-y-2');

            }, 100);


            setTimeout(() => {

                toast.classList.add('opacity-0','translate-y-2');

                setTimeout(() => toast.remove(), 300);

            }, 2500);

        }



        /* ================= CART COUNT ================= */
        async function loadCartCount(){

            try{

                const res = await fetch("/customer/cart/count", {

                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    },

                    cache: "no-store"

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
        window.showToast = showToast;



        /* ================= INIT ================= */
        window.addEventListener("load", loadCartCount);



        /* ================= REALTIME ================= */
        setInterval(loadCartCount, 5000);

    </script>



    <!-- ================= STACK SCRIPT ================= -->
    @stack('scripts')



    <!-- ================= MOBILE NAV ================= -->
    <div class="
        md:hidden
        fixed bottom-0 left-0 right-0
        bg-white/95
        backdrop-blur-xl
        border-t border-gray-200
        z-50
        shadow-[0_-4px_20px_rgba(0,0,0,0.06)]
    ">

        <div class="
            grid grid-cols-4
            h-16
        ">

            <!-- HOME -->
            <a
                href="{{ route('customer.dashboard') }}"
                class="
                    relative
                    flex flex-col
                    items-center justify-center
                    gap-1
                    transition
                    {{
                        request()->routeIs('customer.dashboard')
                        ? 'text-teal-600'
                        : 'text-gray-400'
                    }}
                "
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V10z"/>

                </svg>

                <span class="
                    text-[11px]
                    font-medium
                ">
                    Home
                </span>

            </a>



            <!-- SERVICE -->
            <a
                href="{{ route('customer.services') }}"
                class="
                    relative
                    flex flex-col
                    items-center justify-center
                    gap-1
                    transition
                    {{
                        request()->routeIs('customer.services*')
                        ? 'text-teal-600'
                        : 'text-gray-400'
                    }}
                "
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>

                </svg>

                <span class="
                    text-[11px]
                    font-medium
                ">
                    Layanan
                </span>

            </a>



            <!-- CART -->
            <a
                href="{{ route('customer.cart') }}"
                class="
                    relative
                    flex flex-col
                    items-center justify-center
                    gap-1
                    transition
                    {{
                        request()->routeIs('customer.cart')
                        ? 'text-teal-600'
                        : 'text-gray-400'
                    }}
                "
            >

                <!-- BADGE -->
                <span class="
                    cart-count
                    hidden
                    absolute
                    top-2 right-7
                    bg-red-500
                    text-white
                    text-[10px]
                    font-semibold
                    min-w-[18px]
                    h-[18px]
                    px-1
                    rounded-full
                    flex items-center justify-center
                    shadow
                ">
                    0
                </span>


                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m4 0a1 1 0 102 0"/>

                </svg>

                <span class="
                    text-[11px]
                    font-medium
                ">
                    Keranjang
                </span>

            </a>



            <!-- ORDER -->
            <a
                href="{{ route('customer.orders') }}"
                class="
                    relative
                    flex flex-col
                    items-center justify-center
                    gap-1
                    transition
                    {{
                        request()->routeIs('customer.orders*')
                        ? 'text-teal-600'
                        : 'text-gray-400'
                    }}
                "
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                </svg>

                <span class="
                    text-[11px]
                    font-medium
                ">
                    Riwayat
                </span>

            </a>

        </div>

    </div>

</body>

</html>