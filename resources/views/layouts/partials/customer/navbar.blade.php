@php
    $user = auth()->user();
@endphp

<nav class="sticky top-0 left-0 w-full z-50">

    <!-- ================= MOBILE NAV ================= -->
    <div class="md:hidden bg-teal-700 text-white px-4 py-3 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo-pth.png') }}" class="h-7">
            <span class="text-sm font-semibold">PijatJogja.com</span>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-3">

            <!-- CART -->
            <a href="{{ route('customer.cart') }}" class="relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4"></path>
                </svg>

                <span class="cart-count hidden absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full"></span>
            </a>


            <!-- ================= PROFILE DROPDOWN (MOBILE) ================= -->
            <div x-data="{ open: false }" class="relative">

                <!-- TRIGGER -->
                <button @click="open = !open">

                    <img
                        src="{{ $user->foto 
                            ? asset('storage/'.$user->foto) 
                            : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                        class="w-7 h-7 rounded-full object-cover border border-white"
                    >

                </button>

                <!-- DROPDOWN -->
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-3 w-44 bg-white text-gray-700 rounded-xl shadow-lg py-2 z-[999]"
                >

                    <a href="{{ route('customer.profile') }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-100">
                        Profile
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


    <!-- ================= DESKTOP NAV ================= -->
    <div class="hidden md:block bg-teal-700 text-white">

        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-pth.png') }}" class="h-9">
                <span class="font-semibold text-lg">PijatJogja.com</span>
            </div>

            <!-- MENU -->
            <div class="flex gap-8 text-sm">
                <a href="{{ route('customer.dashboard') }}">Home</a>
                <a href="{{ route('customer.services') }}">Layanan</a>
                <a href="{{ route('customer.cart') }}">Keranjang</a>
                <a href="{{ route('customer.orders') }}">Riwayat</a>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- CART -->
                <a href="{{ route('customer.cart') }}" class="relative">

                    <div class="bg-white/20 p-2 rounded-full hover:bg-white/30 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                        </svg>
                    </div>

                    <span class="cart-count hidden absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full"></span>

                </a>


                <!-- ================= PROFILE DROPDOWN (DESKTOP) ================= -->
                <div x-data="{ open: false }" class="relative">

                    <button @click="open = !open">
                        <img
                            src="{{ $user->foto 
                                ? asset('storage/'.$user->foto) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                            class="w-8 h-8 rounded-full border border-white object-cover"
                        >
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-3 w-48 bg-white text-gray-700 rounded-xl shadow-lg py-2 z-[999]"
                    >

                        <a href="{{ route('customer.profile') }}"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
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

    </div>

</nav>