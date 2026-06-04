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
    <script
        defer
        src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <!-- APP CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

</head>

<body class="
    bg-gray-100
    text-gray-800
">

<div class="min-h-screen bg-gray-100">

    <!-- ================= SIDEBAR ================= -->
    <aside class="
        hidden md:flex
        fixed top-0 left-0
        w-64
        h-screen
        z-50
        flex-col
    ">

        @include('layouts.partials.superadmin.sidebar')

    </aside>


    <!-- ================= MAIN ================= -->
    <div class="
        md:ml-64
        flex flex-col
        min-h-screen
    ">

        <!-- ================= TOPBAR ================= -->
        <header class="
            bg-white
            border-b border-gray-100
            sticky top-0
            z-40
        ">

            <div class="
                flex items-center justify-between
                px-4 md:px-6
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
                        text-sm text-gray-400
                        mt-0.5
                    ">

                        Super Admin Panel

                    </p>

                </div>


                <!-- ================= USER MENU ================= -->
                <div
                    x-data="{ open: false }"
                    class="
                        relative
                        flex items-center
                        gap-4
                    "
                >

                    <!-- USER NAME -->
                    <span class="
                        hidden sm:block
                        text-sm
                        text-gray-600
                        font-medium
                    ">

                        {{ auth()->user()->name ?? 'User' }}

                    </span>


                    <!-- AVATAR -->
                    <button
                        @click="open = !open"
                        class="
                            w-10 h-10
                            rounded-2xl
                            overflow-hidden
                            bg-teal-600
                            text-white
                            flex items-center justify-center
                            font-semibold
                            shadow-sm
                            hover:scale-105
                            transition
                        "
                    >

                        {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}

                    </button>


                    <!-- ================= DROPDOWN ================= -->
                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        @click.outside="open = false"
                        class="
                            absolute right-0 top-14
                            w-64
                            bg-white
                            border border-gray-100
                            rounded-3xl
                            shadow-xl
                            overflow-hidden
                            z-50
                        "
                    >

                        <!-- USER -->
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


                        <!-- LOGOUT -->
                        <div class="p-3">

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <button
                                    class="
                                        w-full
                                        text-left
                                        px-4 py-3
                                        rounded-2xl
                                        text-sm font-medium
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
            p-4 md:p-6
            pb-24 md:pb-6
        ">

            <div class="
                max-w-7xl
                mx-auto
            ">

                @yield('content')

            </div>

        </main>


        <!-- ================= FOOTER ================= -->
        <footer class="
            hidden md:block
            bg-white
            border-t border-gray-100
            px-6 py-4
            text-sm text-gray-400
            text-center
        ">

            © {{ date('Y') }} PijatJogja.com

        </footer>

    </div>

</div>


<!-- ================= MOBILE NAVIGATION ================= -->
<div class="
    md:hidden
    fixed bottom-0 left-0 right-0
    bg-white/95
    backdrop-blur-lg
    border-t border-gray-200
    z-50
    shadow-[0_-4px_20px_rgba(0,0,0,0.06)]
">

    <div class="
        grid grid-cols-4
        h-16
    ">

        <!-- DASHBOARD -->
        <a
            href="{{ route('superadmin.dashboard') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('superadmin.dashboard')
                    ? 'text-teal-600'
                    : 'text-gray-400'
                }}
            "
        >

            <!-- ICON -->
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
                Dashboard
            </span>

        </a>


        <!-- LAYANAN -->
        <a
            href="{{ route('superadmin.services') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('superadmin.services*')
                    ? 'text-teal-600'
                    : 'text-gray-400'
                }}
            "
        >

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>

            </svg>

            <span class="
                text-[11px]
                font-medium
            ">
                Layanan
            </span>

        </a>


        <!-- LANDING -->
        <a
            href="{{ route('superadmin.landing') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('superadmin.landing*')
                    ? 'text-teal-600'
                    : 'text-gray-400'
                }}
            "
        >

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 5h18M3 12h18M3 19h18"/>

            </svg>

            <span class="
                text-[11px]
                font-medium
            ">
                Landing
            </span>

        </a>


        <!-- KARYAWAN -->
        <a
            href="{{ route('superadmin.karyawan.index') }}"
            class="
                flex flex-col
                items-center justify-center
                gap-1
                transition
                {{
                    request()->routeIs('superadmin.karyawan*')
                    ? 'text-teal-600'
                    : 'text-gray-400'
                }}
            "
        >

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>

            </svg>

            <span class="
                text-[11px]
                font-medium
            ">
                Karyawan
            </span>

        </a>

    </div>

</div>

@yield('script')

</body>
</html>