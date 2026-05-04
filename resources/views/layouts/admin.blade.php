<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>

<body class="bg-[#EEF6F3] text-gray-800">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR (DESKTOP ONLY) ================= -->
    <aside class="hidden md:flex md:w-64 flex-col">
        @include('layouts.partials.admin.sidebar')
    </aside>


    <!-- ================= MAIN ================= -->
    <div class="flex flex-col flex-1 min-w-0">

        <!-- ================= TOPBAR ================= -->
        <header class="bg-white border-b">

            <div class="flex items-center justify-between px-6 py-4">

                <h1 class="text-lg font-semibold">
                    @yield('header','Dashboard')
                </h1>


                <!-- ================= USER DROPDOWN ================= -->
                <div 
                    x-data="{ open: false }"
                    class="relative z-50"
                >

                    <!-- TRIGGER -->
                    <button 
                        @click="open = !open"
                        class="text-sm text-gray-600 hover:text-teal-600 font-medium transition"
                    >
                        {{ auth()->user()->name ?? 'User' }}
                    </button>

                    <!-- DROPDOWN -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-3 w-52 bg-white border rounded-xl shadow-lg py-2 z-[999]"
                    >

                        <div class="px-4 py-2 border-b">
                            <p class="text-sm font-medium text-gray-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </header>


        <!-- ================= CONTENT ================= -->
        <main class="flex-1 p-4 md:p-6 pb-20 md:pb-6">

            <div class="max-w-7xl mx-auto" x-data>
                @yield('content')
            </div>

        </main>


        <!-- ================= FOOTER ================= -->
        <footer class="hidden md:block bg-white border-t px-6 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Pijat.in
        </footer>

    </div>

</div>


<!-- ================= MOBILE BOTTOM NAV ================= -->
<div class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t z-50">

    <div class="grid grid-cols-4 text-xs text-gray-600">

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('admin.dashboard') ? 'text-teal-600' : '' }}">
            🏠
            <span>Home</span>
        </a>

        <!-- ORDER -->
        <a href="{{ route('admin.orders.status') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('admin.orders.*') ? 'text-teal-600' : '' }}">
            📦
            <span>Order</span>
        </a>

        <!-- TERAPIS -->
        <a href="{{ route('admin.therapist.index') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('admin.therapist.*') ? 'text-teal-600' : '' }}">
            👨‍⚕️
            <span>Terapis</span>
        </a>

        <!-- REPORT -->
        <a href="{{ route('admin.report.index') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('admin.report.*') ? 'text-teal-600' : '' }}">
            📊
            <span>Report</span>
        </a>

    </div>

</div>

@yield('script')

</body>
</html>