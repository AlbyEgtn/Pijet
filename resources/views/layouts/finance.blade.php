<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Finance Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    @include('layouts.partials.finance.sidebar')
    
    <!-- MAIN -->
    <div class="flex flex-col flex-1 w-full">

        <!-- NAVBAR -->
        {{-- NAVBAR --}}
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

        <!-- CONTENT -->
        <main class="flex-1 p-4 md:p-6 pb-20 md:pb-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="hidden md:block bg-white border-t px-6 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Pijat.in
        </footer>

    </div>

</div>


<!-- ================= MOBILE BOTTOM NAV ================= -->
<div class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t z-50">

    <div class="grid grid-cols-4 text-xs text-gray-600">

        <a href="{{ route('finance.dashboard') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('finance.dashboard') ? 'text-teal-600' : '' }}">
            🏠
            <span>Dashboard</span>
        </a>

        <a href="{{ route('finance.transaction.transfer') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('finance.transaction.*') ? 'text-teal-600' : '' }}">
            💳
            <span>Transaksi</span>
        </a>

        <a href="{{ route('finance.recap') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('finance.recap') ? 'text-teal-600' : '' }}">
            📊
            <span>Recap</span>
        </a>

        <a href="{{ route('finance.setting') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('finance.setting') ? 'text-teal-600' : '' }}">
            ⚙️
            <span>Setting</span>
        </a>

    </div>

</div>

@yield('scripts')

</body>
</html>