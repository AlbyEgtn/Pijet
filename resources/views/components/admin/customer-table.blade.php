@props([
    'data' => []
])

<div class="
    bg-white
    rounded-3xl
    shadow-sm
    border border-gray-100
    overflow-hidden
">

    <!-- ================= HEADER ================= -->
    <div class="
        px-5 md:px-6
        py-5
        border-b border-gray-100
    ">

        <div class="
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-4
        ">

            <!-- TITLE -->
            <div>

                <h2 class="text-lg font-semibold text-gray-800">
                    Data Pelanggan
                </h2>

                <p class="text-sm text-gray-400 mt-1">
                    Monitoring data customer dan transaksi
                </p>

            </div>


            <!-- SEARCH -->
            <form method="GET"
                class="
                    flex flex-col sm:flex-row
                    gap-3
                    w-full lg:w-auto
                ">

                <!-- INPUT -->
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama pelanggan atau nomor HP..."
                    class="
                        w-full lg:w-80
                        px-4 py-3
                        rounded-2xl
                        border border-gray-200
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        focus:border-transparent
                        outline-none
                    "
                >


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="
                        bg-teal-600
                        hover:bg-teal-700
                        transition
                        text-white
                        px-5 py-3
                        rounded-2xl
                        text-sm font-medium
                        shadow-sm
                    "
                >

                    Cari

                </button>

            </form>

        </div>

    </div>


    <!-- ================= MOBILE VIEW ================= -->
    <div class="block md:hidden">

        @forelse($data as $item)

        <div class="
            p-5
            border-b border-gray-100
            space-y-4
        ">

            <!-- TOP -->
            <div class="
                flex items-start justify-between
                gap-3
            ">

                <div class="min-w-0">

                    <p class="
                        font-semibold
                        text-gray-800
                        truncate
                    ">
                        {{ $item->customer_name }}
                    </p>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        {{ $item->customer_phone }}
                    </p>

                </div>


                <!-- TOTAL -->
                <div class="
                    px-3 py-1.5
                    rounded-full
                    bg-teal-50
                    text-teal-700
                    text-xs font-semibold
                    whitespace-nowrap
                ">

                    {{ $item->total_transactions ?? 0 }} Order

                </div>

            </div>


            <!-- DETAIL -->
            <div class="
                grid grid-cols-2
                gap-4
                text-sm
            ">

                <!-- TRANSAKSI -->
                <div>

                    <p class="text-gray-400 text-xs mb-1">
                        Total Transaksi
                    </p>

                    <p class="font-medium text-gray-700">
                        {{ $item->total_transactions ?? 0 }}
                    </p>

                </div>


                <!-- LAST ORDER -->
                <div>

                    <p class="text-gray-400 text-xs mb-1">
                        Order Terakhir
                    </p>

                    <p class="font-medium text-gray-700">
                        {{ $item->last_order
                            ? \Carbon\Carbon::parse($item->last_order)->format('d M Y')
                            : '-' }}
                    </p>

                </div>

            </div>


            <!-- ACTION -->
            <a href="{{ route('admin.customer.detail', $item->customer_phone) }}"
                class="
                    block
                    w-full
                    text-center
                    bg-blue-50
                    text-blue-600
                    py-3
                    rounded-2xl
                    text-sm font-medium
                    hover:bg-blue-100
                    transition
                ">

                Detail Pelanggan

            </a>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="
            p-10
            text-center
        ">

            <div class="text-5xl mb-3">
                👥
            </div>

            <p class="text-gray-500 font-medium">
                Data pelanggan tidak ditemukan
            </p>

        </div>

        @endforelse

    </div>


    <!-- ================= DESKTOP TABLE ================= -->
    <div class="hidden md:block overflow-x-auto">

        <table class="min-w-full text-sm">

            <!-- HEADER -->
            <thead class="
                bg-gray-50
                text-gray-500
                text-xs
                uppercase
            ">

                <tr>

                    <th class="px-6 py-4 text-left font-medium">
                        Nama
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        No HP
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Total Transaksi
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Terakhir Order
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Aksi
                    </th>

                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($data as $item)

                <tr class="hover:bg-gray-50 transition">

                    <!-- NAMA -->
                    <td class="px-6 py-4">

                        <div>

                            <p class="font-medium text-gray-800">
                                {{ $item->customer_name }}
                            </p>

                        </div>

                    </td>


                    <!-- PHONE -->
                    <td class="
                        px-6 py-4
                        text-center
                        text-gray-600
                    ">

                        {{ $item->customer_phone }}

                    </td>


                    <!-- TOTAL -->
                    <td class="
                        px-6 py-4
                        text-center
                    ">

                        <span class="
                            inline-flex items-center
                            px-3 py-1.5
                            rounded-full
                            bg-teal-50
                            text-teal-700
                            text-xs font-semibold
                        ">

                            {{ $item->total_transactions ?? 0 }} Order

                        </span>

                    </td>


                    <!-- LAST ORDER -->
                    <td class="
                        px-6 py-4
                        text-center
                        text-gray-600
                    ">

                        {{ $item->last_order
                            ? \Carbon\Carbon::parse($item->last_order)->format('d M Y')
                            : '-' }}

                    </td>


                    <!-- ACTION -->
                    <td class="
                        px-6 py-4
                        text-center
                    ">

                        <a href="{{ route('admin.customer.detail', $item->customer_phone) }}"
                            class="
                                inline-flex items-center
                                justify-center
                                px-4 py-2
                                rounded-xl
                                text-xs font-medium
                                bg-blue-50
                                text-blue-600
                                hover:bg-blue-100
                                transition
                            ">

                            Detail

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="
                            text-center
                            p-10
                            text-gray-400
                        ">

                        Data pelanggan tidak ditemukan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- ================= PAGINATION ================= -->
    <div class="
        px-5 md:px-6
        py-4
        border-t border-gray-100
        bg-white
    ">

        {{ $data->links() }}

    </div>

</div>