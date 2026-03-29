<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.partials.terapis.terapis_sidebar')


    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        @include('layouts.partials.terapis.terapis_topbar')

        {{-- CONTENT --}}
        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>