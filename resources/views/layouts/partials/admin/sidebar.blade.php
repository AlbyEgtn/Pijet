<aside class="w-64 bg-[#E7F1EE] min-h-screen flex flex-col border-r">

    <!-- LOGO -->
    <div class="px-6 py-6 flex items-center gap-3">

        <img
            src="{{ asset('images/logo.png') }}"
            class="w-10 h-10 bg-white rounded object-contain"
        >

        <span class="text-xl font-semibold text-[#3E7F73]">
            Pijat.in
        </span>

    </div>


    <!-- MENU -->
    <nav class="flex-1 px-4 space-y-2 text-[15px]">

        <!-- Seluruh Kota -->
        <div class="flex items-center justify-between text-gray-600 px-3 py-2 cursor-pointer">

            Seluruh Kota

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 9l-7 7-7-7"/>

            </svg>

        </div>


        <!-- Dashboard -->
        <a href="#"
           class="flex items-center gap-3 px-3 py-3 rounded-lg bg-[#4C9A8B] text-white">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 13h8V3H3v10zM13 21h8V11h-8v10zM13 3v6h8V3h-8zM3 21v-6h8v6H3z"/>

            </svg>

            Dashboard

        </a>


        <!-- Order Dropdown -->
        <div x-data="{ open: false }">

            <!-- Parent Menu -->
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-3 rounded-lg hover:bg-gray-200"
            >

                <div class="flex items-center gap-3">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6M9 8h6M5 3h14a2 2 0 012 2v14"/>

                    </svg>

                    Order

                </div>

                <svg
                    class="w-4 h-4 transition-transform"
                    :class="{'rotate-180': open}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"/>

                </svg>

            </button>


            <!-- Dropdown Menu -->
            <div
                x-show="open"
                x-transition
                class="ml-9 mt-1 space-y-1 text-sm"
            >

                <a href="{{ route('admin.orders.status') }}"
                class="block px-3 py-2 rounded hover:bg-gray-200">

                    Status Order

                </a>

                <a href="{{ route('admin.orders.waiting') }}"
                class="block px-3 py-2 rounded hover:bg-gray-200">

                    Menunggu

                </a>

                <a href="{{ route('admin.orders.finished') }}"
                class="block px-3 py-2 rounded hover:bg-gray-200">

                    Selesai

                </a>

                <a href="{{ route('admin.orders.reschedule') }}"
                class="block px-3 py-2 rounded hover:bg-gray-200">

                    Reschedule

                </a>

            </div>

        </div>


        <!-- Data Pelanggan -->
        <a href="#"
           class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-200">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5.121 17.804A7 7 0 1118.88 6.197"/>

            </svg>

            Data Pelanggan

        </a>


        <!-- DATA TERAPIS -->
        <div x-data="{ open: true }">
            <button @click="open = !open" 
                    class="flex items-center justify-between w-full px-4 py-2 text-left hover:bg-green-100 rounded-lg">
                <span>👥 Data Terapis</span>
                <span x-show="!open">▼</span>
                <span x-show="open">▲</span>
            </button>

            <div x-show="open" class="ml-4 mt-2 space-y-1">
                <a href="{{ route('admin.therapist.index') }}" 
                class="block px-4 py-2 rounded-lg hover:bg-green-200">
                    Akun
                </a>

                <a href="{{ route('admin.therapist.verification') }}" 
                class="block px-4 py-2 rounded-lg hover:bg-green-200">
                    Verifikasi
                </a>

                <a href="{{ route('admin.therapist.review') }}" 
                class="block px-4 py-2 rounded-lg hover:bg-green-200">
                    Rating & Ulasan
                </a>
            </div>
        </div>


        <!-- Penangguhan -->
        <a href="#"
           class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-200">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 9v2m0 4h.01"/>

            </svg>

            Penangguhan

        </a>


        <!-- Report -->
        <a href="#"
           class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-200">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 17v-6m4 6v-4m4 4v-8"/>

            </svg>

            Report

        </a>

    </nav>


    <!-- LOGOUT -->
    <div class="p-4">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button class="bg-red-500 text-white px-4 py-2 rounded-lg w-full text-sm">

                Keluar

            </button>

        </form>

    </div>

</aside>