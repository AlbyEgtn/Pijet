@props([
    'transactions',
    'type' => 'cash'
])

<div class="
    bg-white
    rounded-3xl
    border border-gray-100
    shadow-sm
    overflow-hidden
">

    <!-- ================= HEADER ================= -->
    <div class="
        p-5 md:p-6
        border-b border-gray-100
        bg-white
        space-y-5
    ">

        <!-- TOP -->
        <div class="
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-4
        ">

            <!-- TITLE -->
            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    text-gray-800
                ">
                    Data Transaksi
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Monitoring seluruh transaksi customer.
                </p>

            </div>


            <!-- TOTAL -->
            <span class="
                px-4 py-2
                rounded-2xl
                bg-teal-50
                text-teal-700
                text-sm font-medium
                w-fit
            ">

                {{ $transactions->total() ?? 0 }} Transaksi

            </span>

        </div>


        <!-- SEARCH -->
        <form
            method="GET"
            class="
                flex flex-col lg:flex-row
                lg:items-center
                gap-3
            "
        >

            <!-- INPUT -->
            <div class="
                relative
                flex-1
            ">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nomor id, customer, kota, dll..."
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        pr-12
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                        transition
                    "
                >

                <!-- ICON -->
                <div class="
                    absolute right-4 top-1/2
                    -translate-y-1/2
                    text-gray-400
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>

                    </svg>

                </div>

            </div>


            <!-- ACTION -->
            <div class="
                flex items-center
                gap-3
            ">

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="
                        bg-teal-600
                        hover:bg-teal-700
                        text-white
                        px-6 py-3
                        rounded-2xl
                        text-sm font-semibold
                        transition
                        shadow-sm
                    "
                >

                    Cari

                </button>


                <!-- FILTER -->
                <button
                    type="button"
                    class="
                        border border-gray-200
                        hover:bg-gray-50
                        text-gray-600
                        px-5 py-3
                        rounded-2xl
                        text-sm
                        transition
                    "
                >

                    Filter

                </button>

            </div>

        </form>

    </div>



    <!-- ================= MOBILE CARD ================= -->
    <div class="block md:hidden">

        @forelse($transactions as $trx)

            @php
                $statusClass = match($trx->status) {
                    'lunas' => 'bg-green-100 text-green-600',
                    'belum_lunas' => 'bg-yellow-100 text-yellow-600',
                    'dibatalkan' => 'bg-red-100 text-red-600',
                    'reschedule' => 'bg-blue-100 text-blue-600',
                    default => 'bg-gray-100 text-gray-500'
                };
            @endphp

            <div class="
                p-5
                border-b border-gray-100
                space-y-4
            ">

                <!-- TOP -->
                <div class="
                    flex items-start justify-between
                    gap-4
                ">

                    <!-- LEFT -->
                    <div>

                        <h3 class="
                            font-semibold
                            text-gray-800
                        ">
                            {{ $trx->transaction_code }}
                        </h3>

                        <p class="
                            text-sm
                            text-gray-500
                            mt-1
                        ">
                            {{ $trx->customer_name }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        {{ $statusClass }}
                    ">

                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                    </span>

                </div>


                <!-- DETAIL -->
                <div class="
                    grid grid-cols-2
                    gap-4
                    text-sm
                ">

                    <!-- LAYANAN -->
                    <div>

                        <p class="text-gray-400">
                            Layanan
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                            mt-1
                        ">
                            {{ $trx->service_count }}
                        </p>

                    </div>


                    <!-- TERAPIS -->
                    <div>

                        <p class="text-gray-400">
                            Terapis
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                            mt-1
                        ">
                            {{ $trx->therapist_filled }}
                        </p>

                    </div>


                    <!-- TOTAL -->
                    <div>

                        <p class="text-gray-400">
                            Total
                        </p>

                        <p class="
                            font-semibold
                            text-gray-800
                            mt-1
                        ">
                            Rp{{ number_format($trx->total_price) }}
                        </p>

                    </div>


                    <!-- DATE -->
                    <div>

                        <p class="text-gray-400">
                            Tanggal
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                            mt-1
                        ">
                            {{ $trx->execution_date }}
                        </p>

                    </div>

                </div>


                <!-- PAYMENT -->
                <div>

                    <span class="
                        inline-flex items-center
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        {{
                            $trx->payment_method == 'transfer'
                            ? 'bg-blue-100 text-blue-600'
                            : 'bg-green-100 text-green-600'
                        }}
                    ">

                        {{ ucfirst($trx->payment_method) }}

                    </span>

                </div>


                <!-- RESCHEDULE -->
                @if($type == 'reschedule')

                    <div class="
                        bg-blue-50
                        rounded-2xl
                        px-4 py-3
                        text-sm
                    ">

                        <p class="text-blue-400">
                            Jadwal Reschedule
                        </p>

                        <p class="
                            font-medium
                            text-blue-700
                            mt-1
                        ">

                            {{ $trx->reschedule_date ?? '-' }}

                        </p>

                    </div>

                @endif


                <!-- REFUND -->
                @if($type == 'cancel')

                    <div class="
                        bg-gray-50
                        rounded-2xl
                        px-4 py-3
                        text-sm
                    ">

                        <p class="text-gray-400">
                            Status Refund
                        </p>

                        <div class="mt-2">

                            @if($trx->refund_status == 'success')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-blue-100
                                    text-blue-600
                                ">
                                    Sukses
                                </span>

                            @elseif($trx->refund_status == 'pending')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-yellow-100
                                    text-yellow-600
                                ">
                                    Pending
                                </span>

                            @else

                                <span class="
                                    text-gray-500
                                    text-sm
                                ">
                                    -

                                </span>

                            @endif

                        </div>

                    </div>

                @endif


                <!-- ACTION -->
                <a
                    href="{{ route('finance.transaction.detail',$trx->id) }}"
                    class="
                        flex items-center justify-center
                        bg-teal-50
                        hover:bg-teal-100
                        text-teal-700
                        py-3
                        rounded-2xl
                        text-sm font-semibold
                        transition
                    "
                >

                    Lihat Detail

                </a>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="
                py-16
                text-center
            ">

                <div class="
                    w-20 h-20
                    mx-auto
                    rounded-full
                    bg-gray-100
                    flex items-center justify-center
                    text-3xl
                    mb-4
                ">
                    📄
                </div>

                <p class="
                    text-gray-400
                    text-sm
                ">
                    Data transaksi tidak ditemukan
                </p>

            </div>

        @endforelse

    </div>



    <!-- ================= DESKTOP TABLE ================= -->
    <div class="
        hidden md:block
        overflow-x-auto
    ">

        <table class="min-w-full text-sm">

            <!-- HEADER -->
            <thead class="
                bg-gray-50
                text-gray-500
                text-xs uppercase
            ">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Nomor ID
                    </th>

                    <th class="px-6 py-4 text-left">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-center">
                        Layanan
                    </th>

                    <th class="px-6 py-4 text-center">
                        Terapis
                    </th>

                    <th class="px-6 py-4 text-right">
                        Total
                    </th>

                    <th class="px-6 py-4 text-center">
                        Tanggal
                    </th>

                    <th class="px-6 py-4 text-center">
                        Metode
                    </th>

                    @if($type == 'reschedule')

                        <th class="px-6 py-4 text-center">
                            Reschedule
                        </th>

                    @endif


                    @if($type == 'cancel')

                        <th class="px-6 py-4 text-center">
                            Refund
                        </th>

                    @endif

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($transactions as $trx)

                    @php
                        $statusClass = match($trx->status) {
                            'lunas' => 'bg-green-100 text-green-600',
                            'belum_lunas' => 'bg-yellow-100 text-yellow-600',
                            'dibatalkan' => 'bg-red-100 text-red-600',
                            'reschedule' => 'bg-blue-100 text-blue-600',
                            default => 'bg-gray-100 text-gray-500'
                        };
                    @endphp

                    <tr class="
                        hover:bg-gray-50
                        transition
                    ">

                        <!-- ID -->
                        <td class="
                            px-6 py-5
                            font-semibold
                            text-gray-800
                        ">

                            {{ $trx->transaction_code }}

                        </td>


                        <!-- CUSTOMER -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $trx->customer_name }}

                        </td>


                        <!-- LAYANAN -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                bg-gray-100
                                text-gray-600
                                text-xs font-semibold
                            ">

                                {{ $trx->service_count }}

                            </span>

                        </td>


                        <!-- TERAPIS -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                bg-gray-100
                                text-gray-600
                                text-xs font-semibold
                            ">

                                {{ $trx->therapist_filled }}

                            </span>

                        </td>


                        <!-- TOTAL -->
                        <td class="
                            px-6 py-5
                            text-right
                            font-semibold
                            text-gray-800
                        ">

                            Rp{{ number_format($trx->total_price) }}

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-5
                            text-center
                            text-gray-600
                        ">

                            {{ $trx->execution_date }}

                        </td>


                        <!-- PAYMENT -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{
                                    $trx->payment_method == 'transfer'
                                    ? 'bg-blue-100 text-blue-600'
                                    : 'bg-green-100 text-green-600'
                                }}
                            ">

                                {{ ucfirst($trx->payment_method) }}

                            </span>

                        </td>


                        <!-- RESCHEDULE -->
                        @if($type == 'reschedule')

                            <td class="
                                px-6 py-5
                                text-center
                                text-gray-600
                            ">

                                {{ $trx->reschedule_date ?? '-' }}

                            </td>

                        @endif


                        <!-- REFUND -->
                        @if($type == 'cancel')

                            <td class="
                                px-6 py-5
                                text-center
                            ">

                                @if($trx->refund_status == 'success')

                                    <span class="
                                        px-3 py-1.5
                                        rounded-full
                                        text-xs font-semibold
                                        bg-blue-100
                                        text-blue-600
                                    ">

                                        Sukses

                                    </span>

                                @elseif($trx->refund_status == 'pending')

                                    <span class="
                                        px-3 py-1.5
                                        rounded-full
                                        text-xs font-semibold
                                        bg-yellow-100
                                        text-yellow-600
                                    ">

                                        Pending

                                    </span>

                                @else

                                    -

                                @endif

                            </td>

                        @endif


                        <!-- STATUS -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <span class="
                                inline-flex items-center
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{ $statusClass }}
                            ">

                                {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                            </span>

                        </td>


                        <!-- ACTION -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <a
                                href="{{ route('finance.transaction.detail',$trx->id) }}"
                                class="
                                    inline-flex items-center justify-center
                                    px-4 py-2
                                    rounded-xl
                                    bg-teal-50
                                    hover:bg-teal-100
                                    text-teal-700
                                    text-sm font-semibold
                                    transition
                                "
                            >

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10"
                            class="
                                text-center
                                py-12
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
        px-6 py-5
        border-t border-gray-100
        bg-white
    ">

        {{ $transactions->links() }}

    </div>

</div>