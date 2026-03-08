@php
    $role = auth()->user()->role;
@endphp

<aside class="w-64 bg-white border-r">

    <div class="p-6 font-bold text-teal-600">
        pijet.in
    </div>

    <nav class="px-4 space-y-2">

        {{-- SUPER ADMIN --}}
        @if ($role === 'super_admin')

            <a href="/super-admin/dashboard"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Dashboard
            </a>

            <a href="/super-admin/users"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Manajemen User
            </a>

        @endif


        {{-- ADMIN --}}
        @if ($role === 'admin')

            <a href="/admin/dashboard"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Dashboard
            </a>

            <a href="/admin/booking"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Booking
            </a>

        @endif


        {{-- FINANCE --}}
        @if ($role === 'finance')

            <a href="/finance/dashboard"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Dashboard
            </a>

            <a href="/finance/transaction"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Transaksi
            </a>

        @endif


        {{-- TERAPIS --}}
        @if ($role === 'terapis')

            <a href="/terapis/dashboard"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Dashboard
            </a>

            <a href="/terapis/jadwal"
               class="block px-3 py-2 rounded hover:bg-gray-100">
                Jadwal Terapis
            </a>

        @endif

    </nav>

</aside>