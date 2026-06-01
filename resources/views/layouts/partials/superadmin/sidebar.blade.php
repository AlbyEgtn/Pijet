<aside class="
    hidden md:flex
    w-64
    bg-gradient-to-b from-teal-700 to-teal-900
    text-white
    flex-col
    h-screen
    overflow-y-auto
    shadow-xl
">

    <!-- ================= LOGO ================= -->
    <div class="
        px-6 py-7
        border-b border-white/10
    ">

        <div class="
            flex items-center gap-3
        ">

            <!-- LOGO -->
            <img
                src="{{ asset('images/logo-pth.png') }}"
                alt="Logo Pijat.in"
                class="w-10 h-10 object-contain"
            >

            <!-- BRAND -->
            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    tracking-wide
                ">
                    Pijat.in
                </h2>

                <p class="
                    text-xs
                    text-teal-100
                    mt-0.5
                ">
                    Super Admin Panel
                </p>

            </div>

        </div>

    </div>


    <!-- ================= MENU ================= -->
    <nav class="
        flex-1
        px-4 py-5
        space-y-2
        overflow-y-auto
    ">

        <!-- DASHBOARD -->
        <a
            href="{{ route('superadmin.dashboard') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition
                {{ request()->routeIs('superadmin.dashboard')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/80 hover:bg-white/10 hover:text-white'
                }}
            "
        >

            Dashboard

        </a>


        <!-- LAYANAN -->
        <a
            href="{{ route('superadmin.services') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition
                {{ request()->routeIs('superadmin.services*')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/80 hover:bg-white/10 hover:text-white'
                }}
            "
        >

            Layanan

        </a>


        <!--
        <a
            href="{{ route('superadmin.cabang.index') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition
                {{ request()->routeIs('superadmin.cabang*')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/80 hover:bg-white/10 hover:text-white'
                }}
            "
        >

            Cabang

        </a> -->


        <!-- KARYAWAN -->
        <a
            href="{{ route('superadmin.karyawan.index') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition
                {{ request()->routeIs('superadmin.karyawan*')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/80 hover:bg-white/10 hover:text-white'
                }}
            "
        >

            Karyawan

        </a>


        <!-- LANDING -->
        <a
            href="{{ route('superadmin.landing') }}"
            class="
                block
                px-4 py-3
                rounded-2xl
                text-sm
                transition
                {{ request()->routeIs('superadmin.landing*')
                    ? 'bg-white text-teal-700 font-semibold shadow-sm'
                    : 'text-white/80 hover:bg-white/10 hover:text-white'
                }}
            "
        >

            Landing Page

        </a>


        <!-- ================= PENGGUNA ================= -->
        <div
            x-data="{
                open: {{ request()->is('superadmin/pengguna*') ? 'true' : 'false' }}
            }"
            class="space-y-2"
        >

            <!-- HEADER -->
            <button
                @click="open = !open"
                class="
                    w-full
                    flex items-center justify-between
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition
                    text-white/80
                    hover:bg-white/10
                    hover:text-white
                "
            >

                <span>Pengguna</span>

                <svg
                    :class="{'rotate-180': open}"
                    class="
                        w-4 h-4
                        transition-transform
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


            <!-- SUB MENU -->
            <div
                x-show="open"
                x-transition
                class="
                    space-y-2
                    pl-3
                "
            >

                <!-- PELANGGAN -->
                <a
                    href="{{ route('superadmin.pengguna', 'pelanggan') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{ request()->is('superadmin/pengguna/pelanggan')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/70 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    Pelanggan

                </a>


                <!-- TERAPIS -->
                <a
                    href="{{ route('superadmin.pengguna', 'terapis') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{ request()->is('superadmin/pengguna/terapis')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/70 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    Terapis

                </a>

            </div>

        </div>


        <!-- ================= PENANGGUHAN ================= -->
        <div
            x-data="{
                open: {{ request()->is('superadmin/penangguhan*') ? 'true' : 'false' }}
            }"
            class="space-y-2"
        >

            <!-- HEADER -->
            <button
                @click="open = !open"
                class="
                    w-full
                    flex items-center justify-between
                    px-4 py-3
                    rounded-2xl
                    text-sm
                    transition
                    text-white/80
                    hover:bg-white/10
                    hover:text-white
                "
            >

                <span>Penangguhan</span>

                <svg
                    :class="{'rotate-180': open}"
                    class="
                        w-4 h-4
                        transition-transform
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


            <!-- SUBMENU -->
            <div
                x-show="open"
                x-transition
                class="
                    space-y-2
                    pl-3
                "
            >

                <!-- ADUAN -->
                <a
                    href="{{ route('superadmin.penangguhan', 'aduan') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{ request()->is('superadmin/penangguhan/aduan')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/70 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    Aduan Pengguna

                </a>


                <!-- DITANGGUHKAN -->
                <a
                    href="{{ route('superadmin.penangguhan', 'ditangguhkan') }}"
                    class="
                        block
                        px-4 py-2.5
                        rounded-xl
                        text-sm
                        transition
                        {{ request()->is('superadmin/penangguhan/ditangguhkan')
                            ? 'bg-white text-teal-700 font-medium'
                            : 'text-white/70 hover:bg-white/10 hover:text-white'
                        }}
                    "
                >

                    Ditangguhkan

                </a>

            </div>

        </div>

    </nav>


    <!-- ================= LOGOUT ================= -->
    <div class="
        px-4 py-5
        border-t border-white/10
    ">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                class="
                    w-full
                    px-4 py-3
                    rounded-2xl
                    text-sm font-medium
                    text-left
                    text-white/80
                    hover:bg-white/10
                    hover:text-white
                    transition
                "
            >

                Logout

            </button>

        </form>

    </div>

</aside>