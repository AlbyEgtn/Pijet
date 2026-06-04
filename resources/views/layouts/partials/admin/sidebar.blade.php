<aside class="
    w-64
    bg-gradient-to-b
    from-teal-700
    via-teal-800
    to-teal-900
    text-white
    fixed inset-y-0 left-0
    flex flex-col
    shadow-xl
    z-40
">

    <!-- ================= LOGO ================= -->
    <div class="
        px-6 py-6
        border-b border-white/10
        shrink-0
    ">

        <div class="flex items-center gap-3">

            <img
                src="{{ asset('images/logo-pth.png') }}"
                alt="Logo PijatJogja.com"
                class="w-10 h-10 object-contain"
            >

            <div>

                <h2 class="text-xl font-semibold tracking-wide">
                    PijatJogja.com
                </h2>

                <p class="text-xs text-teal-100 mt-1">
                    Admin Panel
                </p>

            </div>

        </div>

    </div>


    <!-- ================= MENU ================= -->
    <div class="flex-1 overflow-y-auto">

        <nav class="
            px-4 py-5
            space-y-2
            text-sm
        ">

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    transition-all duration-200

                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Dashboard

            </a>


            <!-- ================= ORDER ================= -->
            @php
                $orderActive = request()->routeIs('admin.orders.*');
            @endphp

            <div
                x-data="{ open: {{ $orderActive ? 'true' : 'false' }} }"
                class="space-y-2"
            >

                <!-- MAIN -->
                <button
                    @click="open = !open"
                    class="
                        w-full
                        flex items-center justify-between
                        px-4 py-3
                        rounded-2xl
                        transition-all duration-200

                        {{ $orderActive
                            ? 'bg-white text-teal-700 font-semibold shadow-sm'
                            : 'text-white/90 hover:bg-white/10'
                        }}
                    "
                >

                    <span>
                        Pesanan
                    </span>

                    <svg
                        class="w-4 h-4 transition-transform duration-200"
                        :class="open ? 'rotate-180' : ''"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />

                    </svg>

                </button>


                <!-- SUBMENU -->
                <div
                    x-show="open"
                    x-transition
                    class="space-y-1 pl-3"
                >

                    <a href="{{ route('admin.orders.status') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.orders.status')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Status Order

                    </a>


                    <a href="{{ route('admin.orders.waiting') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.orders.waiting')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Menunggu

                    </a>


                    <a href="{{ route('admin.orders.finished') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.orders.finished')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Selesai

                    </a>


                    <a href="{{ route('admin.orders.reschedule') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.orders.reschedule')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Reschedule

                    </a>

                </div>

            </div>


            <!-- ================= CUSTOMER ================= -->
            <a href="{{ route('admin.customer.index') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    transition-all duration-200

                    {{ request()->routeIs('admin.customer.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Data Pelanggan

            </a>


            <!-- ================= TERAPIS ================= -->
            @php
                $terapisActive = request()->routeIs('admin.therapist.*');
            @endphp

            <div
                x-data="{ open: {{ $terapisActive ? 'true' : 'false' }} }"
                class="space-y-2"
            >

                <!-- MAIN -->
                <button
                    @click="open = !open"
                    class="
                        w-full
                        flex items-center justify-between
                        px-4 py-3
                        rounded-2xl
                        transition-all duration-200

                        {{ $terapisActive
                            ? 'bg-white text-teal-700 font-semibold shadow-sm'
                            : 'text-white/90 hover:bg-white/10'
                        }}
                    "
                >

                    <span>
                        Data Terapis
                    </span>

                    <svg
                        class="w-4 h-4 transition-transform duration-200"
                        :class="open ? 'rotate-180' : ''"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />

                    </svg>

                </button>


                <!-- SUBMENU -->
                <div
                    x-show="open"
                    x-transition
                    class="space-y-1 pl-3"
                >

                    <a href="{{ route('admin.therapist.index') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.therapist.index')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Akun

                    </a>


                    <a href="{{ route('admin.therapist.verification') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.therapist.verification')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Verifikasi

                    </a>


                    <a href="{{ route('admin.therapist.review') }}"
                        class="
                            block
                            px-4 py-2
                            rounded-xl
                            transition

                            {{ request()->routeIs('admin.therapist.review')
                                ? 'bg-white/20 font-medium'
                                : 'hover:bg-white/10 text-white/80'
                            }}
                        ">

                        Rating & Ulasan

                    </a>

                </div>

            </div>


            <!-- ================= REPORT ================= -->
            <a href="{{ route('admin.report.index') }}"
                class="
                    block
                    px-4 py-3
                    rounded-2xl
                    transition-all duration-200

                    {{ request()->routeIs('admin.report.*')
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                ">

                Report

            </a>

        </nav>

    </div>


    <!-- ================= LOGOUT ================= -->
    <div class="
        p-4
        border-t border-white/10
        shrink-0
    ">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="
                    w-full
                    text-left
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    text-white/90
                    hover:bg-white/10
                    transition-all duration-200
                "
            >

                Logout

            </button>

        </form>

    </div>

</aside>