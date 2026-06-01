@extends('layouts.finance')

@section('title','Rekap Transaksi')
@section('header','Rekap Transaksi')

@section('content')

<div class="space-y-6">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-56 h-56
            bg-white/10
            rounded-full
            blur-3xl
        "></div>


        <div class="
            relative z-10
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-6
        ">

            <!-- LEFT -->
            <div>

                <p class="
                    text-sm
                    text-teal-100
                    mb-2
                ">
                    Finance Report
                </p>

                <h2 class="
                    text-2xl md:text-4xl
                    font-bold
                ">
                    Rekap Transaksi
                </h2>

                <p class="
                    text-sm md:text-base
                    text-teal-100
                    mt-3
                    max-w-2xl
                ">
                    Monitoring pemasukan, distribusi pendapatan, dan statistik transaksi perusahaan.
                </p>

            </div>


            <!-- INFO -->
            <div class="
                bg-white/10
                backdrop-blur
                rounded-3xl
                px-6 py-5
                min-w-[220px]
            ">

                <p class="
                    text-sm
                    text-teal-100
                ">
                    Total Data
                </p>

                <h3 class="
                    text-3xl
                    font-bold
                    mt-2
                ">
                    {{ $transactions->total() ?? 0 }}
                </h3>

                <p class="
                    text-xs
                    text-teal-100
                    mt-2
                ">
                    Seluruh transaksi tersedia
                </p>

            </div>

        </div>

    </div>



    <!-- ================= FILTER ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-5 md:p-6
    ">

        <form
            method="GET"
            class="
                grid grid-cols-1
                md:grid-cols-2
                xl:grid-cols-4
                gap-4
            "
        >

            <!-- STATUS -->
            <div>

                <label class="
                    block
                    text-sm
                    font-medium
                    text-gray-700
                    mb-2
                ">
                    Status
                </label>

                <select
                    name="status"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="completed"
                        {{ request('status') == 'completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                    <option
                        value="cancelled"
                        {{ request('status') == 'cancelled' ? 'selected' : '' }}
                    >
                        Cancelled
                    </option>

                </select>

            </div>


            <!-- FROM -->
            <div>

                <label class="
                    block
                    text-sm
                    font-medium
                    text-gray-700
                    mb-2
                ">
                    Dari Tanggal
                </label>

                <input
                    type="date"
                    name="date_from"
                    value="{{ request('date_from') }}"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

            </div>


            <!-- TO -->
            <div>

                <label class="
                    block
                    text-sm
                    font-medium
                    text-gray-700
                    mb-2
                ">
                    Sampai Tanggal
                </label>

                <input
                    type="date"
                    name="date_to"
                    value="{{ request('date_to') }}"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

            </div>


            <!-- BUTTON -->
            <div class="
                flex items-end
            ">

                <button
                    class="
                        w-full
                        bg-teal-600
                        hover:bg-teal-700
                        text-white
                        py-3.5
                        rounded-2xl
                        text-sm font-semibold
                        transition
                        shadow-sm
                    "
                >

                    Terapkan Filter

                </button>

            </div>

        </form>

    </div>



    <!-- ================= SUMMARY ================= -->
    <div class="
        grid grid-cols-1
        sm:grid-cols-2
        xl:grid-cols-3
        gap-5
    ">

        <!-- TOTAL -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Total Transaksi
                    </p>

                    <h2 class="
                        text-2xl
                        font-bold
                        text-gray-800
                        mt-2
                    ">
                        Rp {{ number_format($totalIncome,0,',','.') }}
                    </h2>

                </div>


                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-gray-100
                    flex items-center justify-center
                    text-xl
                ">
                    💳
                </div>

            </div>

        </div>


        <!-- THERAPIST -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Terapis (70%)
                    </p>

                    <h2 class="
                        text-2xl
                        font-bold
                        text-red-500
                        mt-2
                    ">
                        Rp {{ number_format($totalTherapist,0,',','.') }}
                    </h2>

                </div>


                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-red-100
                    text-red-500
                    flex items-center justify-center
                    text-xl
                ">
                    👨‍⚕️
                </div>

            </div>

        </div>


        <!-- COMPANY -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Perusahaan (30%)
                    </p>

                    <h2 class="
                        text-2xl
                        font-bold
                        text-teal-700
                        mt-2
                    ">
                        Rp {{ number_format($totalCompany,0,',','.') }}
                    </h2>

                </div>


                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-teal-100
                    text-teal-700
                    flex items-center justify-center
                    text-xl
                ">
                    🏢
                </div>

            </div>

        </div>

    </div>



    <!-- ================= TABLE ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        overflow-hidden
    ">

        <!-- MOBILE -->
        <div class="block md:hidden">

            @forelse($transactions as $trx)

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
                        <div>

                            @if($trx->order_status == 'completed')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-green-100
                                    text-green-600
                                ">

                                    Completed

                                </span>

                            @elseif($trx->order_status == 'cancelled')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-red-100
                                    text-red-500
                                ">

                                    Cancelled

                                </span>

                            @else

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-gray-100
                                    text-gray-500
                                ">

                                    {{ $trx->order_status }}

                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- GRID -->
                    <div class="
                        grid grid-cols-2
                        gap-4
                        text-sm
                    ">

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
                                {{ $trx->created_at->format('d M Y') }}
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
                                Rp {{ number_format($trx->total_price,0,',','.') }}
                            </p>

                        </div>


                        <!-- THERAPIST -->
                        <div>

                            <p class="text-gray-400">
                                Terapis
                            </p>

                            <p class="
                                font-semibold
                                text-red-500
                                mt-1
                            ">
                                Rp {{ number_format($trx->therapist_income ?? 0,0,',','.') }}
                            </p>

                        </div>


                        <!-- COMPANY -->
                        <div>

                            <p class="text-gray-400">
                                Company
                            </p>

                            <p class="
                                font-semibold
                                text-teal-700
                                mt-1
                            ">
                                Rp {{ number_format($trx->company_income ?? 0,0,',','.') }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

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
                        Data transaksi tidak tersedia
                    </p>

                </div>

            @endforelse

        </div>



        <!-- DESKTOP -->
        <div class="
            hidden md:block
            overflow-x-auto
        ">

            <table class="w-full text-sm">

                <!-- HEADER -->
                <thead class="
                    bg-gray-50
                    text-gray-500
                    text-xs uppercase
                ">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Kode
                        </th>

                        <th class="px-6 py-4 text-left">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-right">
                            Total
                        </th>

                        <th class="px-6 py-4 text-right">
                            Terapis
                        </th>

                        <th class="px-6 py-4 text-right">
                            Company
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @foreach($transactions as $trx)

                        <tr class="
                            hover:bg-gray-50
                            transition
                        ">

                            <!-- KODE -->
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


                            <!-- DATE -->
                            <td class="
                                px-6 py-5
                                text-gray-500
                            ">

                                {{ $trx->created_at->format('d M Y') }}

                            </td>


                            <!-- TOTAL -->
                            <td class="
                                px-6 py-5
                                text-right
                                font-semibold
                                text-gray-800
                            ">

                                Rp {{ number_format($trx->total_price,0,',','.') }}

                            </td>


                            <!-- THERAPIST -->
                            <td class="
                                px-6 py-5
                                text-right
                                font-semibold
                                text-red-500
                            ">

                                Rp {{ number_format($trx->therapist_income ?? 0,0,',','.') }}

                            </td>


                            <!-- COMPANY -->
                            <td class="
                                px-6 py-5
                                text-right
                                font-semibold
                                text-teal-700
                            ">

                                Rp {{ number_format($trx->company_income ?? 0,0,',','.') }}

                            </td>


                            <!-- STATUS -->
                            <td class="
                                px-6 py-5
                                text-center
                            ">

                                @if($trx->order_status == 'completed')

                                    <span class="
                                        px-3 py-1.5
                                        rounded-full
                                        text-xs font-semibold
                                        bg-green-100
                                        text-green-600
                                    ">

                                        Completed

                                    </span>

                                @elseif($trx->order_status == 'cancelled')

                                    <span class="
                                        px-3 py-1.5
                                        rounded-full
                                        text-xs font-semibold
                                        bg-red-100
                                        text-red-500
                                    ">

                                        Cancelled

                                    </span>

                                @else

                                    <span class="
                                        px-3 py-1.5
                                        rounded-full
                                        text-xs font-semibold
                                        bg-gray-100
                                        text-gray-500
                                    ">

                                        {{ $trx->order_status }}

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>



    <!-- ================= PAGINATION ================= -->
    <div class="
        flex justify-end
    ">

        {{ $transactions->links() }}

    </div>

</div>

@endsection