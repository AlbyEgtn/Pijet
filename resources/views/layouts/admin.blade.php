<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Admin Dashboard')</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ALPINE -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- APP CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        [x-cloak]{
            display:none !important;
        }

        .scrollbar-hide::-webkit-scrollbar{
            display:none;
        }

        .scrollbar-hide{
            -ms-overflow-style:none;
            scrollbar-width:none;
        }
    </style>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
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
                        Admin Panel
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

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition-all duration-200

                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Dashboard

            </a>


            <!-- ORDER -->
            <a href="{{ route('admin.orders.status') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition-all duration-200

                    {{ request()->routeIs('admin.orders.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Pesanan

            </a>


            <!-- CUSTOMER -->
            <a href="{{ route('admin.customer.index') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition-all duration-200

                    {{ request()->routeIs('admin.customer.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Pelanggan

            </a>


            <!-- TERAPIS -->
            <a href="{{ route('admin.therapist.index') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition-all duration-200

                    {{ request()->routeIs('admin.therapist.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Terapis

            </a>


            <!-- REPORT -->
            <a href="{{ route('admin.report.index') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition-all duration-200

                    {{ request()->routeIs('admin.report.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Report

            </a>

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


    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col w-full min-w-0">

        <!-- ================= TOPBAR ================= -->
        <header class="
            sticky top-0 z-40
            bg-white/90 backdrop-blur-lg
            border-b border-gray-100
            px-4 md:px-8
            py-4
        ">

            <div class="flex items-center justify-between gap-4">

                <!-- LEFT -->
                <div class="min-w-0">

                    <p class="text-xs text-gray-400 mb-1">
                        Admin Panel
                    </p>

                    <h1 class="text-lg md:text-xl font-bold text-gray-800 truncate">
                        @yield('header','Dashboard')
                    </h1>

                </div>


                <!-- ================= USER MENU ================= -->
                <div
                    x-data="{ open: false }"
                    class="relative flex items-center gap-3"
                >

                    <!-- USER INFO -->
                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-medium text-gray-700 leading-tight">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Administrator
                        </p>

                    </div>


                    <!-- PROFILE BUTTON -->
                    <button
                        @click="open = !open"
                        class="
                            relative
                            w-11 h-11
                            rounded-2xl
                            overflow-hidden
                            border border-gray-200
                            shadow-sm
                            flex items-center justify-center
                            bg-teal-600
                            text-white
                            text-sm font-semibold
                            hover:shadow-md
                            transition
                        "
                    >

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </button>


                    <!-- ================= DROPDOWN ================= -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="
                            absolute right-0 top-14
                            w-72
                            bg-white
                            border border-gray-100
                            rounded-3xl
                            shadow-2xl
                            overflow-hidden
                            z-50
                        "
                        style="display:none;"
                    >

                        <!-- PROFILE -->
                        <div class="
                            bg-gradient-to-r from-teal-600 to-teal-700
                            px-5 py-5
                            text-white
                        ">

                            <div class="flex items-center gap-4">

                                <div class="
                                    w-14 h-14
                                    rounded-2xl
                                    bg-white/20
                                    flex items-center justify-center
                                    text-lg font-bold
                                ">

                                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                                </div>

                                <div class="min-w-0">

                                    <p class="font-semibold truncate">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="text-sm text-teal-100 truncate">
                                        {{ auth()->user()->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- MENU -->
                        <div class="p-2">

                            <a href="{{ route('admin.dashboard') }}"
                                class="
                                    block
                                    px-4 py-3
                                    rounded-2xl
                                    text-sm text-gray-700
                                    hover:bg-gray-50
                                    transition
                                ">

                                Dashboard

                            </a>


                            <a href="{{ route('admin.report.index') }}"
                                class="
                                    block
                                    px-4 py-3
                                    rounded-2xl
                                    text-sm text-gray-700
                                    hover:bg-gray-50
                                    transition
                                ">

                                Report

                            </a>

                        </div>


                        <!-- LOGOUT -->
                        <div class="
                            border-t border-gray-100
                            p-2
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
                                        text-red-500
                                        hover:bg-red-50
                                        transition
                                    "
                                >

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </header>


        <!-- ================= CONTENT ================= -->
        <main class="p-4 md:p-8 pb-24 md:pb-8 flex-1">

            @yield('content')

        </main>

    </div>

</div>


<!-- ================= MOBILE BOTTOM NAV ================= -->
<div class="
    md:hidden
    fixed bottom-0 left-0 right-0
    bg-white/95 backdrop-blur-lg
    border-t border-gray-200
    z-50
    shadow-[0_-4px_20px_rgba(0,0,0,0.06)]
">

    <div class="grid grid-cols-4 h-16">

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('admin.dashboard')
                ? 'text-teal-600'
                : 'text-gray-400' }}">

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

            <span class="text-[11px] font-medium">
                Dashboard
            </span>

        </a>


        <!-- ORDER -->
        <a href="{{ route('admin.orders.status') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('admin.orders.*')
                ? 'text-teal-600'
                : 'text-gray-400' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>

            </svg>

            <span class="text-[11px] font-medium">
                Order
            </span>

        </a>


        <!-- TERAPIS -->
        <a href="{{ route('admin.therapist.index') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('admin.therapist.*')
                ? 'text-teal-600'
                : 'text-gray-400' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>

            </svg>

            <span class="text-[11px] font-medium">
                Terapis
            </span>

        </a>


        <!-- REPORT -->
        <a href="{{ route('admin.report.index') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('admin.report.*')
                ? 'text-teal-600'
                : 'text-gray-400' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 17v-6m4 6V7m4 10v-3M5 21h14"/>

            </svg>

            <span class="text-[11px] font-medium">
                Report
            </span>

        </a>

    </div>

</div>

@yield('script')

</body>
</html>