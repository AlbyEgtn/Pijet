@php
    $user = auth()->user();
@endphp

<nav class="bg-gradient-to-r from-teal-600 to-teal-500 text-white border-b shadow-sm">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            <!-- ================= LOGO ================= -->
            <div class="flex items-center gap-3">

                <img src="{{ asset('images/logo-pth.png') }}"
                     class="w-9 h-9 object-contain">

                <span class="font-semibold text-lg tracking-wide">
                    Pijat.in
                </span>

            </div>


            <!-- ================= MENU ================= -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium">

                <a href="{{ route('customer.dashboard') }}"
                   class="hover:text-teal-100 transition
                   {{ request()->routeIs('customer.dashboard') ? 'underline underline-offset-4' : '' }}">
                    Home
                </a>

                <a href="{{ route('customer.services') }}"
                   class="hover:text-teal-100 transition
                   {{ request()->routeIs('customer.services*') ? 'underline underline-offset-4' : '' }}">
                    Layanan
                </a>

                <a href="{{ route('customer.cart') }}"
                   class="hover:text-teal-100 transition
                   {{ request()->routeIs('customer.cart') ? 'underline underline-offset-4' : '' }}">
                    Keranjang
                </a>

                <a href="{{ route('customer.orders') }}"
                   class="hover:text-teal-100 transition
                   {{ request()->routeIs('customer.orders*') ? 'underline underline-offset-4' : '' }}">
                    Riwayat
                </a>

            </div>


            <!-- ================= RIGHT SIDE ================= -->
            <div class="flex items-center gap-5">

                <!-- CART -->
                <a href="{{ route('customer.cart') }}" class="relative">

                    <div class="bg-white/20 p-2 rounded-full hover:bg-white/30 transition">

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

                    {{-- CART COUNT --}}
                    @isset($cartCount)
                        @if($cartCount > 0)
                            <span
                                id="cart-count"
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full shadow">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @endisset

                </a>


                <!-- USER DROPDOWN -->
                <div x-data="{ open: false }" class="relative">

                    <button @click="open = !open"
                        class="flex items-center gap-2 hover:opacity-90 transition">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                            class="w-8 h-8 rounded-full border border-white"
                        >

                        <span class="text-sm hidden sm:block">
                            {{ $user->name }}
                        </span>

                    </button>


                    <!-- DROPDOWN -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-3 w-48 bg-white text-gray-700 rounded-lg shadow-lg py-2 z-50"
                    >

                        <a href="#"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <a href="{{ route('customer.orders') }}"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Riwayat Pesanan
                        </a>

                        <hr class="my-2">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>


                <!-- ================= MOBILE MENU BUTTON ================= -->
                <div class="md:hidden" x-data="{ open: false }">

                    <button @click="open = !open"
                        class="bg-white/20 p-2 rounded hover:bg-white/30">

                        ☰

                    </button>

                    <!-- MOBILE MENU -->
                    <div
                        x-show="open"
                        x-transition
                        class="absolute left-0 top-16 w-full bg-teal-600 px-6 py-4 space-y-3 text-sm z-40"
                    >

                        <a href="{{ route('customer.dashboard') }}" class="block">
                            Home
                        </a>

                        <a href="{{ route('customer.services') }}" class="block">
                            Layanan
                        </a>

                        <a href="{{ route('customer.cart') }}" class="block">
                            Keranjang
                        </a>

                        <a href="{{ route('customer.orders') }}" class="block">
                            Riwayat
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>