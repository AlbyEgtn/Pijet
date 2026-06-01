<nav class="
    sticky top-0 z-30
    flex items-center justify-between
    px-4 md:px-6
    py-4
    bg-white/90 backdrop-blur-lg
    border-b border-gray-100
">

    <!-- ================= LEFT ================= -->
    <div>

        <p class="text-xs text-gray-400 mb-1">
            Admin Panel
        </p>

        <h1 class="text-lg font-semibold text-gray-800">
            Dashboard
        </h1>

    </div>


    <!-- ================= RIGHT ================= -->
    <div class="flex items-center gap-4">

        <!-- USER -->
        <div class="hidden sm:block text-right">

            <p class="text-sm font-medium text-gray-700 leading-tight">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-gray-400">
                Administrator
            </p>

        </div>


        <!-- AVATAR -->
        <div class="
            w-10 h-10
            rounded-2xl
            bg-teal-600
            text-white
            flex items-center justify-center
            text-sm font-semibold
            shadow-sm
        ">

            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

        </div>


        <!-- LOGOUT -->
        <form method="POST" action="/logout">

            @csrf

            <button
                class="
                    text-sm
                    px-4 py-2
                    rounded-xl
                    text-red-500
                    hover:bg-red-50
                    transition
                "
            >

                Logout

            </button>

        </form>

    </div>

</nav>