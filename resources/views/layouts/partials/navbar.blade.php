@php
    $user = auth()->user();
@endphp

<nav class="bg-gradient-to-r from-teal-600 to-teal-500 text-white shadow">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-pth.png') }}" class="w-9 h-9">
                <span class="font-semibold">Pijat.in</span>
            </div>

            <!-- MENU -->
            <div class="hidden md:flex gap-6">
                <a href="{{ route('customer.dashboard') }}">Home</a>
                <a href="{{ route('customer.services') }}">Layanan</a>
                <a href="{{ route('customer.cart') }}">Keranjang</a>
                <a href="{{ route('customer.orders') }}">Riwayat</a>
            </div>

            <!-- USER -->
            <div x-data="{ open:false }" class="relative">

                <button @click="open=!open">
                    {{ $user->name }}
                </button>

                <div x-show="open" class="absolute right-0 bg-white text-black shadow rounded w-48">

                    <a href="#" class="block px-4 py-2">Profile</a>

                    <a href="{{ route('customer.orders') }}" class="block px-4 py-2">
                        Riwayat
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-red-500">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</nav>