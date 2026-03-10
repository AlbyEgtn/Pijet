<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    {{-- NAVBAR CUSTOMER --}}
    @include('layouts.partials.customer.navbar')

    <main class="p-6">

        @yield('content')

    </main>

    {{-- FOOTER --}}
    @include('layouts.partials.footer')

</body>

</html>