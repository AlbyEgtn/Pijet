<nav class="bg-gradient-to-r from-teal-600 to-teal-500 text-white border-b">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-14">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <img src="/images/logo-pth.png" class="w-8 h-8">

                <span class="font-semibold text-lg tracking-wide">
                    Pijetin
                </span>

            </div>


            <!-- MENU -->
            <div class="flex items-center gap-6 text-sm font-medium">

                <a href="{{ route('customer.dashboard') }}"
                   class="hover:text-teal-100 transition">
                    Home
                </a>

                <a href="{{ route('customer.services') }}"
                   class="hover:text-teal-100 transition">
                    Layanan
                </a>

                <a href="{{ route('customer.cart') }}"
                   class="hover:text-teal-100 transition">
                    Keranjang
                </a>

                <a href="{{ route('customer.orders') }}"
                   class="hover:text-teal-100 transition">
                    Riwayat
                </a>

            </div>


            <!-- RIGHT SIDE -->
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

                    @if($cartCount > 0)
                    <span id="cart-count"
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full">
                        {{ $cartCount }}
                    </span>
                    @endif

                </a>

                <!-- USER -->
                <div class="flex items-center gap-2">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                        class="w-7 h-7 rounded-full border border-white"
                    >

                    <span class="text-sm">
                        {{ auth()->user()->name }}
                    </span>

                </div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-xs bg-white text-teal-600 px-3 py-1 rounded-md hover:bg-gray-100 transition">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>