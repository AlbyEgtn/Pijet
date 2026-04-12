@php
    $user = auth()->user();
@endphp

<nav class="absolute top-0 left-0 w-full z-50">

    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4 text-white">

        <!-- ================= LOGO ================= -->
        <div class="flex items-center gap-3">

            <img src="{{ asset('images/logo-pth.png') }}"
                 class="h-9 w-auto">

            <span class="font-semibold text-lg tracking-wide">
                Pijat.in
            </span>

        </div>


        <!-- ================= MENU ================= -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">

            <a href="{{ route('customer.dashboard') }}"
               class="hover:text-emerald-300 transition
               {{ request()->routeIs('customer.dashboard') ? 'underline underline-offset-4' : '' }}">
                Home
            </a>

            <a href="{{ route('customer.services') }}"
               class="hover:text-emerald-300 transition
               {{ request()->routeIs('customer.services*') ? 'underline underline-offset-4' : '' }}">
                Layanan
            </a>

            <a href="{{ route('customer.cart') }}"
               class="hover:text-emerald-300 transition">
                Keranjang
            </a>

            <a href="{{ route('customer.orders') }}"
               class="hover:text-emerald-300 transition">
                Riwayat
            </a>

        </div>


        <!-- ================= RIGHT ================= -->
        <div class="flex items-center gap-4">

            <!-- CART ICON -->
            <a href="{{ route('customer.cart') }}"
               id="cart-icon"
               class="relative">

                <div class="bg-white/20 backdrop-blur-md p-2 rounded-full hover:bg-white/30 transition">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6
                            8L5.4 5M7 13l-1.5 7h13M9 21a1
                            1 0 100-2 1 1 0 000 2zm9
                            0a1 1 0 100-2 1 1 0 000 2z" />

                    </svg>

                </div>

                <!-- BADGE (FIXED) -->
                <span id="cart-count"
                    class="hidden absolute -top-1 -right-1
                           bg-red-500 text-white text-[10px]
                           px-1.5 py-0.5 rounded-full shadow">
                </span>

            </a>


            <!-- USER -->
            <div x-data="{ open: false }" class="relative">

                <button @click="open = !open"
                    class="flex items-center gap-2 hover:opacity-90">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                        class="w-8 h-8 rounded-full border border-white">

                </button>

                <!-- DROPDOWN -->
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-3 w-48 bg-white text-gray-700 rounded-xl shadow-lg py-2 z-50">

                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        Profile
                    </a>

                    <a href="{{ route('customer.orders') }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-100">
                        Riwayat
                    </a>

                    <hr class="my-2">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</nav>