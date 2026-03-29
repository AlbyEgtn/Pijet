<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Dashboard Admin')</title>

<script src="https://cdn.tailwindcss.com"></script>

<!-- ✅ ALPINE JS -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- ✅ FIX FLICKER -->
<style>
    [x-cloak] { display: none !important; }
</style>

</head>

<body class="bg-[#EEF6F3]">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.partials.admin.sidebar')


    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white px-6 py-4 flex justify-between items-center border-b">

            <h1 class="text-lg font-semibold text-gray-700">
                @yield('header','Dashboard Admin')
            </h1>

            <div class="flex items-center gap-4">

                <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">
                    🔔
                </div>

                <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">
                    ⚙️
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <main class="flex-1 p-6">

            {{-- ✅ ROOT ALPINE SCOPE --}}
            <div x-data>

                @yield('content')

            </div>

        </main>

    </div>

</div>

</body>
</html>