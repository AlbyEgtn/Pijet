@php
    $user = auth()->user();
@endphp

<header class="
    sticky top-0 z-40
    bg-white/90 backdrop-blur-lg
    border-b border-gray-100
    px-4 md:px-8
    py-4
">

    <div class="flex items-center justify-between gap-4">

        <!-- ================= LEFT ================= -->
        <div class="min-w-0">

            <p class="text-xs text-gray-400 mb-1">
                Dashboard Terapis
            </p>

            <h1 class="text-lg md:text-xl font-bold text-gray-800 truncate">
                @yield('title')
            </h1>

        </div>


        <!-- ================= USER MENU ================= -->
        <div
            x-data="{ open: false }"
            class="relative flex items-center gap-3"
        >

            <!-- USER INFO -->
            <div class="hidden sm:block text-right">

                <p class="text-sm font-medium text-gray-700 leading-tight">
                    {{ $user->name }}
                </p>

                <p class="text-xs text-gray-400">
                    Terapis
                </p>

            </div>


            <!-- PROFILE BUTTON -->
            <button
                @click="open = !open"
                class="
                    relative
                    w-11 h-11
                    rounded-2xl
                    overflow-hidden
                    border border-gray-200
                    shadow-sm
                    flex items-center justify-center
                    bg-gray-100
                    hover:shadow-md
                    transition
                "
            >

                @if($user->foto)

                    <img
                        src="{{ asset('storage/'.$user->foto) }}"
                        class="w-full h-full object-cover"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >

                @endif


                <!-- FALLBACK -->
                <span
                    class="
                        text-sm font-bold text-white
                        bg-gradient-to-br from-teal-500 to-teal-700
                        w-full h-full
                        flex items-center justify-center
                    "
                    style="{{ $user->foto ? 'display:none' : '' }}"
                >

                    {{ strtoupper(substr($user->name,0,1)) }}

                </span>

            </button>


            <!-- ================= DROPDOWN ================= -->
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="
                    absolute right-0 top-14
                    w-72
                    bg-white
                    border border-gray-100
                    rounded-3xl
                    shadow-2xl
                    overflow-hidden
                    z-50
                "
                style="display:none;"
            >

                <!-- ================= PROFILE HEADER ================= -->
                <div class="
                    bg-gradient-to-r from-teal-600 to-teal-700
                    px-5 py-5
                    text-white
                ">

                    <div class="flex items-center gap-4">

                        <!-- AVATAR -->
                        <div class="
                            w-14 h-14
                            rounded-2xl
                            overflow-hidden
                            bg-white/20
                            flex items-center justify-center
                            text-lg font-bold
                            shrink-0
                        ">

                            @if($user->foto)

                                <img
                                    src="{{ asset('storage/'.$user->foto) }}"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                {{ strtoupper(substr($user->name,0,1)) }}

                            @endif

                        </div>


                        <!-- INFO -->
                        <div class="min-w-0">

                            <p class="font-semibold truncate">
                                {{ $user->name }}
                            </p>

                            <p class="text-sm text-teal-100 truncate">
                                {{ $user->email }}
                            </p>

                        </div>

                    </div>

                </div>


                <!-- ================= MENU ================= -->
                <div class="p-2">

                    <!-- PROFILE -->
                    <a
                        href="{{ route('terapis.profile') }}"
                        class="
                            flex items-center gap-3
                            px-4 py-3
                            rounded-2xl
                            text-sm text-gray-700
                            hover:bg-gray-50
                            transition
                        "
                    >

                        <span class="text-lg"></span>

                        <span>
                            Profile
                        </span>

                    </a>


                    <!-- INFORMASI -->
                    <a
                        href="{{ route('terapis.informasi.confirm') }}"
                        class="
                            flex items-center gap-3
                            px-4 py-3
                            rounded-2xl
                            text-sm text-gray-700
                            hover:bg-gray-50
                            transition
                        "
                    >

                        <span class="text-lg"></span>

                        <span>
                            Informasi Akun
                        </span>

                    </a>


                    <!-- PEDOMAN -->
                    <a
                        href="{{ route('terapis.pedoman') }}"
                        class="
                            flex items-center gap-3
                            px-4 py-3
                            rounded-2xl
                            text-sm text-gray-700
                            hover:bg-gray-50
                            transition
                        "
                    >

                        <span class="text-lg"></span>

                        <span>
                            Pedoman
                        </span>

                    </a>


                    <!-- REVIEW -->
                    <a
                        href="{{ route('terapis.review') }}"
                        class="
                            flex items-center gap-3
                            px-4 py-3
                            rounded-2xl
                            text-sm text-gray-700
                            hover:bg-gray-50
                            transition
                        "
                    >

                        <span class="text-lg"></span>

                        <span>
                            Rating & Ulasan
                        </span>

                    </a>

                </div>


                <!-- ================= FOOTER ================= -->
                <div class="border-t border-gray-100 p-2">

                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="
                                w-full
                                flex items-center gap-3
                                px-4 py-3
                                rounded-2xl
                                text-sm text-red-600
                                hover:bg-red-50
                                transition
                            "
                        >

                            <span class="text-lg"></span>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>