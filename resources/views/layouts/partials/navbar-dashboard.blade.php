<nav class="flex items-center justify-between px-6 py-3 bg-white border-b">

    <div class="font-semibold">

        Dashboard

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