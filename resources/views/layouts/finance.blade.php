<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Finance Dashboard')</title>

<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

<!-- SIDEBAR -->
@include('layouts.partials.finance.sidebar')

<!-- MAIN CONTENT -->
<div class="flex flex-col flex-1">

    <!-- NAVBAR -->
    <header class="bg-white border-b">
        <div class="flex items-center justify-between px-6 py-4">

            <h1 class="text-lg font-semibold">
                @yield('header','Finance Dashboard')
            </h1>

            <div class="flex items-center gap-4">

                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name ?? 'Finance' }}
                </span>

            </div>

        </div>
    </header>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t px-6 py-4 text-sm text-gray-500">
        © {{ date('Y') }} Pijat.in
    </footer>

</div>

</div>

@yield('scripts')

</body>
</html>