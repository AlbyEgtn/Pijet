<aside class="w-64 bg-teal-800 text-white flex flex-col">

    <div class="p-6 text-xl font-bold border-b border-teal-700">
        Terapis Panel
    </div>


    <nav class="flex-1 p-4 space-y-2">

        <a href="{{ route('terapis.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-teal-700">

            Dashboard

        </a>

        <a href="#"
           class="block px-4 py-2 rounded hover:bg-teal-700">

            Pesanan

        </a>

        <a href="{{ route('terapis.profile') }}"
           class="block px-4 py-2 rounded hover:bg-teal-700">

            Profile

        </a>

    </nav>


    <div class="p-4 border-t border-teal-700 text-sm">

        {{ auth()->user()->name }}

    </div>

</aside>