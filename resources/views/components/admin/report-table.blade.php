@props([
    'data' => [],
    'type' => 'transaction' // transaction | report
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

                    {{ $type === 'report'
                        ? 'Laporan Pembatalan'
                        : 'Daftar Transaksi'
                    }}

                </h2>

                <p class="text-sm text-gray-400 mt-1">

                    {{ $type === 'report'
                        ? 'Monitoring laporan pembatalan transaksi'
                        : 'Monitoring seluruh transaksi customer'
                    }}

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
                    placeholder="Cari nama, no HP..."
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

            @if($type === 'report')

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
                            text-xs
                            text-gray-400
                            mt-1
                        ">
                            {{ $item->transaction_code }}
                        </p>

                    </div>


                    <span class="
                        px-3 py-1.5
                        rounded-full
                        bg-red-100
                        text-red-600
                        text-xs font-semibold
                        whitespace-nowrap
                    ">

                        Cancel

                    </span>

                </div>


                <!-- DETAIL -->
                <div class="
                    grid grid-cols-2
                    gap-4
                    text-sm
                ">

                    <!-- DATE -->
                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Tanggal
                        </p>

                        <p class="font-medium text-gray-700">
                            {{ \Carbon\Carbon::parse($item->service_date)->format('d M Y') }}
                        </p>

                    </div>


                    <!-- PHONE -->
                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            No HP
                        </p>

                        <p class="font-medium text-gray-700">
                            {{ $item->customer_phone }}
                        </p>

                    </div>

                </div>


                <!-- REASON -->
                <div>

                    <p class="text-gray-400 text-xs mb-2">
                        Alasan Pembatalan
                    </p>

                    <div class="
                        bg-red-50
                        text-red-700
                        rounded-2xl
                        p-4
                        text-sm
                        leading-relaxed
                    ">

                        {{ $item->cancel_reason ?? 'Tidak ada keterangan' }}

                    </div>

                </div>

            @else

                @php
                    $statusClass = match($item->status) {
                        'lunas' => 'bg-green-100 text-green-600',
                        'proses' => 'bg-blue-100 text-blue-600',
                        'belum_lunas' => 'bg-gray-100 text-gray-600',
                        'dibatalkan' => 'bg-red-100 text-red-600',
                        'reschedule' => 'bg-yellow-100 text-yellow-600',
                        default => 'bg-gray-100 text-gray-500'
                    };
                @endphp

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
                            text-xs
                            text-gray-400
                            mt-1
                        ">
                            {{ $item->transaction_code }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <span class="
                        inline-flex items-center
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        whitespace-nowrap
                        {{ $statusClass }}
                    ">

                        {{ ucfirst(str_replace('_',' ',$item->status)) }}

                    </span>

                </div>


                <!-- DETAIL -->
                <div class="
                    grid grid-cols-2
                    gap-4
                    text-sm
                ">

                    <!-- DATE -->
                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Jadwal
                        </p>

                        <p class="font-medium text-gray-700">
                            {{ $item->service_date }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Status
                        </p>

                        <p class="font-medium text-gray-700">
                            {{ ucfirst(str_replace('_',' ',$item->status)) }}
                        </p>

                    </div>

                </div>

            @endif

        </div>

        @empty

        <!-- EMPTY -->
        <div class="
            p-10
            text-center
        ">

            <div class="text-5xl mb-3">
                📭
            </div>

            <p class="text-gray-500 font-medium">
                Data tidak ditemukan
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

                    @if($type === 'report')

                        <th class="px-6 py-4 text-left font-medium">
                            Nomor ID
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Nama Pelanggan
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Ponsel
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Alasan
                        </th>

                    @else

                        <th class="px-6 py-4 text-left font-medium">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left font-medium">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Jadwal
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Status
                        </th>

                    @endif

                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($data as $item)

                <tr class="hover:bg-gray-50 transition">

                    @if($type === 'report')

                        <!-- ID -->
                        <td class="
                            px-6 py-4
                            font-medium
                            text-gray-800
                        ">

                            {{ $item->transaction_code }}

                        </td>


                        <!-- CUSTOMER -->
                        <td class="
                            px-6 py-4
                            text-gray-700
                        ">

                            {{ $item->customer_name }}

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-4
                            text-center
                            text-gray-600
                        ">

                            {{ \Carbon\Carbon::parse($item->service_date)->format('d M Y') }}

                        </td>


                        <!-- PHONE -->
                        <td class="
                            px-6 py-4
                            text-center
                            text-gray-600
                        ">

                            {{ $item->customer_phone }}

                        </td>


                        <!-- REASON -->
                        <td class="
                            px-6 py-4
                            text-gray-600
                        ">

                            {{ $item->cancel_reason ?? 'Tidak ada keterangan' }}

                        </td>

                    @else

                        @php
                            $statusClass = match($item->status) {
                                'lunas' => 'bg-green-100 text-green-600',
                                'proses' => 'bg-blue-100 text-blue-600',
                                'belum_lunas' => 'bg-gray-100 text-gray-600',
                                'dibatalkan' => 'bg-red-100 text-red-600',
                                'reschedule' => 'bg-yellow-100 text-yellow-600',
                                default => 'bg-gray-100 text-gray-500'
                            };
                        @endphp

                        <!-- ID -->
                        <td class="
                            px-6 py-4
                            font-medium
                            text-gray-800
                        ">

                            {{ $item->transaction_code }}

                        </td>


                        <!-- CUSTOMER -->
                        <td class="
                            px-6 py-4
                            text-gray-700
                        ">

                            {{ $item->customer_name }}

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-4
                            text-center
                            text-gray-600
                        ">

                            {{ $item->service_date }}

                        </td>


                        <!-- STATUS -->
                        <td class="
                            px-6 py-4
                            text-center
                        ">

                            <span class="
                                inline-flex items-center
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{ $statusClass }}
                            ">

                                {{ ucfirst(str_replace('_',' ',$item->status)) }}

                            </span>

                        </td>

                    @endif

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="
                            text-center
                            p-10
                            text-gray-400
                        ">

                        Data tidak ditemukan

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