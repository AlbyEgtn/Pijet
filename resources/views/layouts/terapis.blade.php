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

<div class="min-h-screen flex">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 bg-white shadow-md fixed inset-y-0 left-0 z-20">
        @include('layouts.partials.terapis.terapis_sidebar')
    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col ml-64">

        <!-- ================= TOPBAR ================= -->
        <header class="bg-white shadow px-6 py-4 sticky top-0 z-10">
            @include('layouts.partials.terapis.terapis_topbar')
        </header>

        <!-- ================= CONTENT ================= -->
        <main class="flex-1 p-6 relative z-0">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>