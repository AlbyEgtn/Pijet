<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Dashboard')</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

<!-- SIDEBAR -->
@include('layouts.partials.superadmin.sidebar')

<!-- MAIN CONTENT -->
<div class="flex flex-col flex-1">

    <!-- NAVBAR -->
    <header class="bg-white border-b">

        <div class="flex items-center justify-between px-6 py-4">

            <h1 class="text-lg font-semibold">

                @yield('header','Dashboard')

            </h1>


            <div class="flex items-center gap-4">

                <span class="text-sm text-gray-600">

                    {{ auth()->user()->name ?? 'User' }}

                </span>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button class="text-sm text-red-500 hover:underline">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </header>



    <!-- PAGE CONTENT -->
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

</body>

</html>
