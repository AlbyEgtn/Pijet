<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @include('layouts.partials.sidebar')

        <div class="flex flex-col flex-1">

            {{-- NAVBAR --}}
            @include('layouts.partials.navbar-dashboard')

            {{-- HEADER --}}
            @include('layouts.partials.header')

            {{-- CONTENT --}}
            <main class="flex-1 p-6">

                @yield('content')

            </main>

            {{-- FOOTER --}}
            @include('layouts.partials.footer')

        </div>

    </div>

</body>

</html>