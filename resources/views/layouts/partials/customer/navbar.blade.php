<nav class="bg-white shadow-md">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            {{-- LOGO --}}
            <div class="flex items-center gap-3">

                <img src="/images/logo.png" class="w-8 h-8">

                <span class="font-semibold text-lg text-gray-800">
                    Pijetin
                </span>

            </div>


            {{-- MENU --}}
            <div class="flex items-center gap-8 text-sm font-medium text-gray-600">

                <a href="{{ route('customer.dashboard') }}"
                   class="hover:text-teal-600 transition">
                    Home
                </a>

                <a href="{{ route('customer.services') }}"
                   class="hover:text-teal-600 transition">
                    Layanan
                </a>

                <a href="{{ route('customer.cart') }}"
                   class="hover:text-teal-600 transition">
                    Keranjang
                </a>

                <a href="{{ route('customer.orders') }}"
                   class="hover:text-teal-600 transition">
                    Riwayat
                </a>

            </div>


            {{-- PROFILE --}}
            <div class="flex items-center gap-6">

                {{-- CART ICON --}}
                <a href="{{ route('customer.cart') }}" class="relative">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-600 hover:text-teal-600"
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

                    @if($cartCount > 0)

                    <span id="cart-count"
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full">

                        {{ $cartCount }}

                    </span>

                    @endif

                </a>

                {{-- USER --}}
                <div class="flex items-center gap-3">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                        class="w-8 h-8 rounded-full"
                    >

                    <span class="text-sm text-gray-700">
                        {{ auth()->user()->name }}
                    </span>

                </div>


                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>