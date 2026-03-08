<nav class="flex items-center justify-between px-6 py-4 bg-white border-b">

    <div class="text-lg font-bold text-teal-600">

        pijet.in

    </div>

    <div class="flex gap-6 text-sm">

        <a href="/customer/dashboard">
            Home
        </a>

        <a href="/customer/booking">
            Booking
        </a>

        <a href="/customer/history">
            Riwayat
        </a>

    </div>

    <div class="flex items-center gap-4">

        <span class="text-sm text-gray-600">
            {{ auth()->user()->name }}
        </span>

        <form method="POST" action="/logout">

            @csrf

            <button class="text-sm text-red-500">
                Logout
            </button>

        </form>

    </div>

</nav>