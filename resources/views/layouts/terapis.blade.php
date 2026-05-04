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

        <main class="p-4 md:p-8 pb-20 md:pb-8">
            @yield('content')
        </main>
    </div>

</div>

{{-- ================= MOBILE BOTTOM NAV ================= --}}
<div class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t z-50">

    <div class="grid grid-cols-3 text-xs text-gray-600">

        <a href="{{ route('terapis.dashboard') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('terapis.dashboard') ? 'text-teal-600' : '' }}">
            🏠
            <span>Dashboard</span>
        </a>

        <a href="{{ route('terapis.pesanan') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('terapis.pesanan') ? 'text-teal-600' : '' }}">
            📦
            <span>Pesanan</span>
        </a>

        <a href="{{ route('terapis.pesanan.saya') }}"
           class="flex flex-col items-center py-2 {{ request()->routeIs('terapis.pesanan.saya') ? 'text-teal-600' : '' }}">
            🧾
            <span>Detail Pesanan</span>
        </a>

    </div>

</div>

</body>
</html>