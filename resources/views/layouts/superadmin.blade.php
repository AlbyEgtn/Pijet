<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Dashboard')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
    .input {
        @apply w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none;
    }
    </style>

</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.partials.superadmin.sidebar')


    {{-- MAIN --}}
    <div class="flex flex-col flex-1">

        {{-- NAVBAR --}}
        <header class="bg-white/80 backdrop-blur border-b sticky top-0 z-40">

            <div class="flex items-center justify-between px-8 py-4">

                <!-- LEFT -->
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">
                        @yield('header','Dashboard')
                    </h1>
                    <p class="text-xs text-gray-400">
                        Panel Super Admin
                    </p>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-5">

                    <!-- USER -->
                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center font-semibold text-green-600">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
                        </div>

                        <div class="hidden sm:block">
                            <p class="text-sm font-medium">
                                {{ auth()->user()->name ?? 'User' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                Super Admin
                            </p>
                        </div>

                    </div>

                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="px-3 py-1.5 text-sm rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition"
                        >
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <main class="flex-1 p-8">

            <div class="max-w-7xl mx-auto space-y-6">

                @yield('content')

            </div>

        </main>


        {{-- FOOTER --}}
        <footer class="px-8 py-4 text-xs text-gray-400 text-center">
            © {{ date('Y') }} Pijat.in — All rights reserved
        </footer>

    </div>

</div>

{{-- SCRIPT --}}
@yield('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>