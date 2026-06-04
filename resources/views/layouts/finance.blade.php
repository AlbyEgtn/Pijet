<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-pth.png') }}">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- APP CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    @include('layouts.partials.finance.sidebar')


    <!-- ================= MAIN ================= -->
    <div class="flex flex-col flex-1 w-full min-w-0">

        <!-- ================= TOPBAR ================= -->
        <header class="
            bg-white/95
            backdrop-blur-lg
            border-b border-gray-200
            sticky top-0
            z-40
        ">

            <div class="
                flex items-center justify-between
                px-4 md:px-8
                py-4
            ">

                <!-- TITLE -->
                <div>

                    <h1 class="
                        text-lg md:text-xl
                        font-semibold
                        text-gray-800
                    ">
                        @yield('header','Dashboard')
                    </h1>

                    <p class="
                        hidden md:block
                        text-xs
                        text-gray-400
                        mt-1
                    ">
                        Finance Management Panel
                    </p>

                </div>


                <!-- ================= USER MENU ================= -->
                <div
                    x-data="{ open: false }"
                    class="
                        relative
                        flex items-center
                        gap-3
                    "
                >

                    <!-- USER NAME -->
                    <div class="
                        hidden sm:block
                        text-right
                    ">

                        <p class="
                            text-sm
                            font-medium
                            text-gray-700
                        ">
                            {{ auth()->user()->name ?? 'Finance' }}
                        </p>

                        <p class="
                            text-xs
                            text-gray-400
                        ">
                            Finance Admin
                        </p>

                    </div>


                    <!-- AVATAR -->
                    <button
                        @click="open = !open"
                        class="
                            w-10 h-10
                            rounded-2xl
                            overflow-hidden
                            bg-gradient-to-br from-teal-500 to-teal-700
                            text-white
                            flex items-center justify-center
                            font-semibold
                            shadow-sm
                        "
                    >

                        @if(auth()->user()->foto)

                            <img
                                src="{{ asset('storage/'.auth()->user()->foto) }}"
                                class="w-full h-full object-cover"
                            >

                        @else

                            {{ strtoupper(substr(auth()->user()->name ?? 'F',0,1)) }}

                        @endif

                    </button>


                    <!-- ================= DROPDOWN ================= -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="
                            absolute right-0 top-14
                            w-64
                            bg-white
                            border border-gray-100
                            rounded-2xl
                            shadow-2xl
                            overflow-hidden
                            z-50
                        "
                    >

                        <!-- USER INFO -->
                        <div class="
                            px-5 py-4
                            border-b border-gray-100
                        ">

                            <p class="
                                text-sm
                                font-semibold
                                text-gray-800
                            ">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="
                                text-xs
                                text-gray-400
                                mt-1
                                break-all
                            ">
                                {{ auth()->user()->email }}
                            </p>

                        </div>


                        <!-- MENU -->
                        <div class="
                            p-2
                            space-y-1
                        ">

                            <!-- DASHBOARD -->
                            <a
                                href="{{ route('finance.dashboard') }}"
                                class="
                                    block
                                    px-4 py-3
                                    rounded-xl
                                    text-sm
                                    text-gray-700
                                    hover:bg-gray-50
                                    transition
                                "
                            >

                                Dashboard

                            </a>


                            <!-- SETTING -->
                            <a
                                href="{{ route('finance.setting') }}"
                                class="
                                    block
                                    px-4 py-3
                                    rounded-xl
                                    text-sm
                                    text-gray-700
                                    hover:bg-gray-50
                                    transition
                                "
                            >

                                Pengaturan

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
                                        rounded-xl
                                        text-sm
                                        text-red-600
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
        <main class="
            flex-1
            p-4 md:p-8
            pb-24 md:pb-8
        ">

            <div class="max-w-7xl mx-auto">

                @yield('content')

            </div>

        </main>


        <!-- ================= FOOTER ================= -->
        <footer class="
            hidden md:block
            bg-white
            border-t border-gray-200
            px-8 py-4
            text-sm
            text-gray-500
        ">

            © {{ date('Y') }} PijatJogja.com Finance Panel

        </footer>

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
        <a
            href="{{ route('finance.dashboard') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('finance.dashboard')
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

            <span class="text-[11px] font-medium">
                Dashboard
            </span>

        </a>


        <!-- TRANSAKSI -->
        <a
            href="{{ route('finance.transaction.transfer') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('finance.transaction.*')
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
                      d="M17 9V7a5 5 0 00-10 0v2m-2 0h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"/>

            </svg>

            <span class="text-[11px] font-medium">
                Transaksi
            </span>

        </a>


        <!-- RECAP -->
        <a
            href="{{ route('finance.recap') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('finance.recap')
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
                      d="M9 17v-6m4 6V7m4 10v-3M5 17v-8"/>

            </svg>

            <span class="text-[11px] font-medium">
                Recap
            </span>

        </a>


        <!-- SETTING -->
        <a
            href="{{ route('finance.setting') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('finance.setting')
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
                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.158c.969 0 1.371 1.24.588 1.81l-3.364 2.445a1 1 0 00-.364 1.118l1.286 3.955c.3.922-.755 1.688-1.54 1.118l-3.364-2.445a1 1 0 00-1.176 0l-3.364 2.445c-.784.57-1.838-.196-1.539-1.118l1.285-3.955a1 1 0 00-.363-1.118L2.98 9.382c-.783-.57-.38-1.81.588-1.81h4.158a1 1 0 00.95-.69l1.373-3.955z"/>

            </svg>

            <span class="text-[11px] font-medium">
                Setting
            </span>

        </a>

    </div>

</div>

@yield('scripts')

</body>
</html>