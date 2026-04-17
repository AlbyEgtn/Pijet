@php
    $user = auth()->user();
@endphp

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
            {{ $user->name }}
        </span>


        <!-- PROFILE ICON -->
        <button
            @click="open = !open"
            class="w-9 h-9 rounded-full overflow-hidden border flex items-center justify-center bg-gray-200"
        >

            @if($user->foto)
                <img 
                    src="{{ asset('storage/'.$user->foto) }}"
                    class="w-full h-full object-cover"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >
            @endif

            <!-- FALLBACK -->
            <span class="text-sm font-semibold text-white bg-gray-400 w-full h-full flex items-center justify-center"
                  style="{{ $user->foto ? 'display:none' : '' }}">
                {{ strtoupper(substr($user->name,0,1)) }}
            </span>

        </button>


        <!-- DROPDOWN -->
        <div
            x-show="open"
            @click.outside="open = false"
            x-transition
            class="absolute right-0 top-12 w-52 bg-white border rounded-lg shadow-md py-2"
        >

            <!-- USER INFO -->
            <div class="px-4 py-2 border-b">
                <p class="text-sm font-medium text-gray-800">
                    {{ $user->name }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ $user->email }}
                </p>
            </div>

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