<header class="bg-white border-b px-8 py-4 flex justify-between items-center">

    <!-- TITLE -->
    <h1 class="text-lg font-semibold">
        @yield('title')
    </h1>


    <!-- USER MENU -->
    <div 
        x-data="{ open: false }"
        class="relative flex items-center gap-4"
    >

        <!-- USER NAME -->
        <span class="text-sm text-gray-600">
            {{ auth()->user()->name }}
        </span>


        <!-- PROFILE ICON -->
        <button
            @click="open = !open"
            class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold text-white"
        >
            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
        </button>


        <!-- DROPDOWN -->
        <div
            x-show="open"
            @click.outside="open = false"
            x-transition
            class="absolute right-0 top-12 w-48 bg-white border rounded-lg shadow-md py-2"
        >

            <!-- PROFILE -->
            <a 
                href="{{ route('terapis.profile') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
                Profile
            </a>


            <!-- INFORMASI -->
            <a 
                href="{{ route('terapis.informasi.confirm') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
                Informasi Akun
            </a>


            <!-- PEDOMAN -->
            <a 
                href="{{ route('terapis.pedoman') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
                Pedoman
            </a>


            <hr class="my-2">


            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</header>