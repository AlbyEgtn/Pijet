<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Admin Dashboard')</title>

<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
</style>

</head>


<body class="bg-[#EEF6F3] text-gray-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('layouts.partials.admin.sidebar')


    <!-- MAIN -->
    <div class="flex flex-col flex-1">

        <!-- TOPBAR -->
        <header class="bg-white border-b px-6 py-4 flex justify-between items-center">

            <h1 class="text-lg font-semibold text-gray-700">
                @yield('header','Dashboard')
            </h1>

            <div class="flex items-center gap-4">

                <!-- USER -->
                <div class="text-sm text-gray-600">
                    {{ auth()->user()->name ?? 'Admin' }}
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <main class="flex-1 p-6">

            <div class="max-w-7xl mx-auto" x-data>

                @yield('content')

            </div>

        </main>


        <!-- FOOTER -->
        <footer class="bg-white border-t px-6 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Pijat.in
        </footer>

    </div>

</div>

@yield('script')

</body>
</html>