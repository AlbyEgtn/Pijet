<header class="bg-white border-b px-8 py-4 flex justify-between items-center">

    <h1 class="text-lg font-semibold">

        @yield('title')

    </h1>


    <div class="flex items-center gap-4">

        <span class="text-sm text-gray-600">

            {{ auth()->user()->name }}

        </span>

        <div class="w-9 h-9 rounded-full bg-gray-300"></div>

    </div>

</header>