@php
    $menus = [
        [
            'title' => 'Dashboard',
            'route' => route('terapis.dashboard'),
            'active' => request()->routeIs('terapis.dashboard'),
        ],
        [
            'title' => 'Pesanan',
            'route' => route('terapis.pesanan'),
            'active' => request()->routeIs('terapis.pesanan'),
        ],
        [
            'title' => 'Pesanan Saya',
            'route' => route('terapis.pesanan.saya'),
            'active' => request()->routeIs('terapis.pesanan.saya*'),
        ],
        [
            'title' => 'Review',
            'route' => route('terapis.review'),
            'active' => request()->routeIs('terapis.review'),
        ],
    ];
@endphp

<aside class="
    hidden md:flex
    w-64
    min-h-screen
    flex-col
    bg-gradient-to-b
    from-teal-700
    via-teal-800
    to-teal-900
    text-white
    shadow-xl
">

    <!-- ================= LOGO ================= -->
    <div class="
        px-6 py-7
        border-b border-white/10
    ">

        <div class="flex items-center gap-3">

            <!-- LOGO -->
            <img src="{{ asset('images/logo-pth.png') }}"
                alt="Logo"
                class="w-11 h-11 object-contain">

            <!-- TEXT -->
            <div>

                <h2 class="text-xl font-semibold tracking-wide">
                    Pijat.in
                </h2>

                <p class="text-xs text-teal-100 mt-1">
                    Terapis Panel
                </p>

            </div>

        </div>

    </div>


    <!-- ================= MENU ================= -->
    <nav class="
        flex-1
        px-4 py-6
        space-y-2
    ">

        @foreach($menus as $menu)

        <a href="{{ $menu['route'] }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition-all duration-200

                {{ $menu['active']
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/90 hover:bg-white/10'
                }}
            ">

            {{ $menu['title'] }}

        </a>

        @endforeach

    </nav>


    <!-- ================= LOGOUT ================= -->
    <div class="
        p-4
        border-t border-white/10
    ">

        <form method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                class="
                    w-full
                    text-left
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    text-white/90
                    hover:bg-white/10
                    transition
                "
            >

                Logout

            </button>

        </form>

    </div>

</aside>