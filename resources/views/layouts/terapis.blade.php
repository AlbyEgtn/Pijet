<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

        {{-- APP CSS (WAJIB untuk scrollbar) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.partials.terapis.terapis_sidebar')

    <div class="flex-1 flex flex-col w-full">
        @include('layouts.partials.terapis.terapis_topbar')

        <main class="p-4 md:p-8 pb-24 md:pb-8">
            @yield('content')
        </main>
    </div>

</div>

{{-- ================= MOBILE BOTTOM NAV ================= --}}
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
        <a href="{{ route('terapis.dashboard') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('terapis.dashboard')
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


        <!-- PESANAN -->
        <a href="{{ route('terapis.pesanan') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('terapis.pesanan')
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
                Pesanan
            </span>

        </a>


        <!-- PESANAN SAYA -->
        <a href="{{ route('terapis.pesanan.saya') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('terapis.pesanan.saya*')
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
                      d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>

            </svg>

            <span class="text-[11px] font-medium">
                Pesanan Saya
            </span>

        </a>


        <!-- REVIEW -->
        <a href="{{ route('terapis.review') }}"
           class="flex flex-col items-center justify-center gap-1 transition
           {{ request()->routeIs('terapis.review')
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
                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.01 6.184a1 1 0 00.95.69h6.504c.969 0 1.371 1.24.588 1.81l-5.26 3.82a1 1 0 00-.364 1.118l2.01 6.183c.3.922-.755 1.688-1.54 1.118l-5.26-3.82a1 1 0 00-1.176 0l-5.26 3.82c-.784.57-1.838-.196-1.539-1.118l2.01-6.183a1 1 0 00-.364-1.118l-5.26-3.82c-.783-.57-.38-1.81.588-1.81h6.504a1 1 0 00.95-.69l2.01-6.184z"/>

            </svg>

            <span class="text-[11px] font-medium">
                Review
            </span>

        </a>

    </div>

</div>

</body>
</html>