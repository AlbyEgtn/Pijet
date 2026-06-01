@extends('layouts.finance')

@section('title','Pengaturan')
@section('header','Pengaturan')

@section('content')

<div class="space-y-6">

    <!-- ================= ALERT ================= -->
    @if(session('success'))

        <div class="
            bg-green-50
            border border-green-200
            text-green-700
            px-5 py-4
            rounded-2xl
            text-sm
        ">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="
            bg-red-50
            border border-red-200
            text-red-700
            px-5 py-4
            rounded-2xl
            text-sm
        ">

            {{ session('error') }}

        </div>

    @endif



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
                    Finance Setting
                </p>

                <h2 class="
                    text-2xl md:text-4xl
                    font-bold
                ">
                    Pengaturan Keuangan
                </h2>

                <p class="
                    text-sm md:text-base
                    text-teal-100
                    mt-3
                    max-w-2xl
                ">
                    Kelola rekening perusahaan, saldo, dan proses withdraw.
                </p>

            </div>


            <!-- BALANCE -->
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
                    Total Saldo Perusahaan
                </p>

                <h3 class="
                    text-2xl md:text-3xl
                    font-bold
                    mt-2
                ">
                    Rp {{ number_format($totalCompany,0,',','.') }}
                </h3>

            </div>

        </div>

    </div>



    <!-- ================= WITHDRAW ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6 md:p-8
    ">

        <!-- HEADER -->
        <div class="mb-6">

            <h2 class="
                text-xl
                font-semibold
                text-gray-800
            ">
                Withdraw Dana
            </h2>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Tarik saldo perusahaan ke rekening tujuan.
            </p>

        </div>


        <!-- FORM -->
        <form
            method="POST"
            action="{{ route('finance.withdraw') }}"
            class="
                grid grid-cols-1
                lg:grid-cols-3
                gap-5
            "
        >

            @csrf

            <!-- NOMINAL -->
            <div>

                <label class="
                    block
                    text-sm
                    font-medium
                    text-gray-700
                    mb-2
                ">
                    Nominal Withdraw
                </label>

                <input
                    type="number"
                    name="amount"
                    required
                    placeholder="Masukkan nominal"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

            </div>


            <!-- BANK -->
            <div>

                <label class="
                    block
                    text-sm
                    font-medium
                    text-gray-700
                    mb-2
                ">
                    Tujuan Bank
                </label>

                <select
                    name="bank_id"
                    required
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

                    @foreach($companyAccounts as $account)

                        @if($account->bank_name !== 'SYSTEM')

                            <option value="{{ $account->id }}">

                                {{ $account->bank_name }}
                                -
                                {{ $account->account_number }}

                            </option>

                        @endif

                    @endforeach

                </select>

            </div>


            <!-- BUTTON -->
            <div class="
                flex items-end
            ">

                <button
                    type="submit"
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

                    Withdraw Dana

                </button>

            </div>

        </form>

    </div>



    <!-- ================= REKENING ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        overflow-hidden
    ">

        <!-- HEADER -->
        <div class="
            px-6 py-5
            border-b border-gray-100
            flex flex-col sm:flex-row
            sm:items-center
            sm:justify-between
            gap-3
        ">

            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    text-gray-800
                ">
                    Rekening Perusahaan
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Daftar rekening aktif perusahaan.
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

                {{ count($companyAccounts) }} Rekening

            </span>

        </div>


        <!-- CONTENT -->
        <div class="
            p-6
            grid grid-cols-1
            xl:grid-cols-2
            gap-5
        ">

            @forelse($companyAccounts as $account)

                @php
                    $balance = $account->balance ?? 0;
                @endphp

                <!-- CARD -->
                <div class="
                    border border-gray-100
                    rounded-3xl
                    p-5
                    hover:shadow-md
                    transition
                    bg-white
                ">

                    <!-- TOP -->
                    <div class="
                        flex items-start justify-between
                        gap-4
                    ">

                        <!-- INFO -->
                        <div class="space-y-2">

                            <div>

                                <p class="
                                    text-lg
                                    font-semibold
                                    text-gray-800
                                ">
                                    {{ $account->bank_name }}
                                </p>

                                <p class="
                                    text-sm
                                    text-gray-500
                                    mt-1
                                ">
                                    {{ $account->account_holder }}
                                </p>

                            </div>


                            <!-- NUMBER -->
                            <div class="
                                bg-gray-50
                                rounded-2xl
                                px-4 py-3
                            ">

                                <p class="
                                    text-xs
                                    text-gray-400
                                    mb-1
                                ">
                                    Nomor Rekening
                                </p>

                                <p class="
                                    text-sm
                                    font-semibold
                                    text-gray-700
                                    tracking-wide
                                ">
                                    {{ $account->account_number }}
                                </p>

                            </div>

                        </div>


                        <!-- STATUS -->
                        <div class="text-right">

                            <span class="
                                inline-flex items-center
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{
                                    $account->is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-500'
                                }}
                            ">

                                {{ $account->is_active ? 'Aktif' : 'Nonaktif' }}

                            </span>

                        </div>

                    </div>


                    <!-- BALANCE -->
                    <div class="
                        mt-5
                        bg-gradient-to-r
                        from-gray-50 to-gray-100
                        rounded-3xl
                        p-5
                    ">

                        <p class="
                            text-sm
                            text-gray-500
                        ">
                            Saldo Rekening
                        </p>

                        <h3 class="
                            text-2xl
                            font-bold
                            mt-2
                            {{
                                $balance > 0
                                ? 'text-teal-700'
                                : 'text-gray-400'
                            }}
                        ">

                            Rp {{ number_format($balance,0,',','.') }}

                        </h3>

                    </div>

                </div>

            @empty

                <!-- EMPTY -->
                <div class="
                    xl:col-span-2
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
                        🏦
                    </div>

                    <p class="
                        text-gray-400
                        text-sm
                    ">
                        Tidak ada rekening aktif
                    </p>

                </div>

            @endforelse

        </div>

    </div>



    <!-- ================= INFORMATION ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6
    ">

        <div class="
            flex items-center
            gap-3
            mb-5
        ">

            <div class="
                w-12 h-12
                rounded-2xl
                bg-teal-100
                text-teal-700
                flex items-center justify-center
                text-xl
            ">
                ℹ
            </div>

            <div>

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Informasi Sistem
                </h3>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Ketentuan pengelolaan saldo dan transaksi.
                </p>

            </div>

        </div>


        <!-- LIST -->
        <div class="
            grid grid-cols-1
            md:grid-cols-3
            gap-4
        ">

            <!-- ITEM -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-5
            ">

                <h4 class="
                    font-semibold
                    text-gray-800
                    mb-2
                ">
                    Transfer
                </h4>

                <p class="
                    text-sm
                    text-gray-500
                    leading-relaxed
                ">
                    Saldo dihitung dari transaksi transfer yang sudah diverifikasi.
                </p>

            </div>


            <!-- ITEM -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-5
            ">

                <h4 class="
                    font-semibold
                    text-gray-800
                    mb-2
                ">
                    Cash
                </h4>

                <p class="
                    text-sm
                    text-gray-500
                    leading-relaxed
                ">
                    Transaksi cash tidak masuk ke rekening perusahaan.
                </p>

            </div>


            <!-- ITEM -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-5
            ">

                <h4 class="
                    font-semibold
                    text-gray-800
                    mb-2
                ">
                    Company Income
                </h4>

                <p class="
                    text-sm
                    text-gray-500
                    leading-relaxed
                ">
                    Saldo merupakan bagian keuntungan perusahaan dari transaksi.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection