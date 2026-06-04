<aside class="
    hidden md:flex
    md:w-64
    flex-col
    bg-gradient-to-b from-teal-700 to-teal-900
    text-white
    shadow-xl
    min-h-screen
">

    <!-- ================= LOGO ================= -->
    <div class="
        px-6 py-7
        flex items-center
        gap-3
        border-b border-white/10
    ">

        <!-- LOGO -->
        <img
            src="{{ asset('images/logo-pth.png') }}"
            alt="Logo PijatJogja.com"
            class="w-10 h-10 object-contain"
        >

        <!-- NAME -->
        <div>

            <h2 class="
                text-xl
                font-semibold
                tracking-wide
            ">
                PijatJogja.com
            </h2>

            <p class="
                text-xs
                text-teal-100
                mt-0.5
            ">
                Finance Panel
            </p>

        </div>

    </div>


    @php
        $transaksiActive = request()->routeIs('finance.transaction.*');
    @endphp


    <!-- ================= MENU ================= -->
    <nav class="
        flex-1
        px-4 py-5
        space-y-2
        text-sm
    ">

        <!-- DASHBOARD -->
        <a
            href="{{ route('finance.dashboard') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                transition-all duration-200
                {{
                    request()->routeIs('finance.dashboard')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/90 hover:bg-white/10'
                }}
            "
        >

            Dashboard

        </a>


        <!-- ================= TRANSAKSI ================= -->
        <div
            x-data="{ open: {{ $transaksiActive ? 'true' : 'false' }} }"
            class="space-y-2"
        >

            <!-- BUTTON -->
            <button
                @click="open = !open"
                class="
                    w-full
                    flex items-center justify-between
                    px-4 py-3
                    rounded-2xl
                    transition-all duration-200
                    {{
                        $transaksiActive
                        ? 'bg-white text-teal-700 font-semibold shadow-sm'
                        : 'text-white/90 hover:bg-white/10'
                    }}
                "
            >

                <span>
                    Transaksi Customer
                </span>


                <!-- ARROW -->
                <svg
                    :class="open ? 'rotate-180' : ''"
                    class="
                        w-4 h-4
                        transition-transform duration-200
                    "
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


            <!-- DROPDOWN -->
            <div
                x-show="open"
                x-transition
                class="
                    ml-2
                    pl-4
                    border-l border-white/10
                    space-y-1
                "
            >

                <!-- TRANSFER -->
                <a
                    href="{{ route('finance.transaction.transfer') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{
                            request()->routeIs('finance.transaction.transfer')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/80 hover:bg-white/10'
                        }}
                    "
                >

                    Pembayaran Transfer

                </a>


                <!-- CASH -->
                <a
                    href="{{ route('finance.transaction.cash') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{
                            request()->routeIs('finance.transaction.cash')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/80 hover:bg-white/10'
                        }}
                    "
                >

                    Pembayaran Cash

                </a>


                <!-- CANCELLED -->
                <a
                    href="{{ route('finance.transaction.cancelled') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{
                            request()->routeIs('finance.transaction.cancelled')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/80 hover:bg-white/10'
                        }}
                    "
                >

                    Transaksi Dibatalkan

                </a>


                <!-- RESCHEDULE -->
                <a
                    href="{{ route('finance.transaction.reschedule') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{
                            request()->routeIs('finance.transaction.reschedule')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/80 hover:bg-white/10'
                        }}
                    "
                >

                    Transaksi Reschedule

                </a>

            </div>

        </div>


        <!-- RECAP -->
        <a
            href="{{ route('finance.recap') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                transition-all duration-200
                {{
                    request()->routeIs('finance.recap')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/90 hover:bg-white/10'
                }}
            "
        >

            Recap Transaksi

        </a>


        <!-- PENGATURAN -->
        <a
            href="{{ route('finance.setting') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                transition-all duration-200
                {{
                    request()->routeIs('finance.setting')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/90 hover:bg-white/10'
                }}
            "
        >

            Pengaturan

        </a>

    </nav>


    <!-- ================= LOGOUT ================= -->
    <div class="
        px-4 pb-6 pt-2
        border-t border-white/10
    ">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                class="
                    w-full
                    px-4 py-3
                    rounded-2xl
                    text-left
                    text-white/90
                    hover:bg-white/10
                    transition-all duration-200
                "
            >

                Keluar Akun

            </button>

        </form>

    </div>

</aside>