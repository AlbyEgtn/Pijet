@extends('layouts.superadmin')

@section('title','Detail Pengguna')
@section('header','Detail Akun')

@section('content')

<div
    x-data="{ openSuspend: false }"
    class="space-y-6"
>

    <!-- ================= BREADCRUMB ================= -->
    <div class="
        flex items-center
        gap-2
        text-sm
        text-gray-400
    ">

        <span>Pengguna</span>

        <span>/</span>

        <span>{{ ucfirst($type) }}</span>

        <span>/</span>

        <span class="
            text-teal-600
            font-medium
        ">
            Detail Akun
        </span>

    </div>


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
            <div class="
                flex items-center
                gap-5
            ">

                <!-- AVATAR -->
                <div class="
                    w-24 h-24 md:w-28 md:h-28
                    rounded-3xl
                    overflow-hidden
                    bg-white/10
                    border border-white/20
                    backdrop-blur
                    flex items-center justify-center
                    text-3xl font-bold
                ">

                    @if($user->foto)

                        <img
                            src="{{ asset('storage/'.$user->foto) }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        {{ strtoupper(substr($user->name,0,1)) }}

                    @endif

                </div>


                <!-- INFO -->
                <div>

                    <p class="
                        text-sm
                        text-teal-100
                        mb-2
                    ">
                        Detail Pengguna
                    </p>

                    <h2 class="
                        text-2xl md:text-4xl
                        font-bold
                    ">
                        {{ $user->name }}
                    </h2>


                    <div class="
                        flex flex-wrap items-center
                        gap-3
                        mt-4
                    ">

                        <!-- ROLE -->
                        <span class="
                            px-4 py-2
                            rounded-2xl
                            bg-blue-100
                            text-blue-700
                            text-sm font-semibold
                        ">

                            {{ ucfirst($user->role) }}

                        </span>


                        <!-- STATUS -->
                        @if($user->is_suspended ?? false)

                            <span class="
                                px-4 py-2
                                rounded-2xl
                                bg-red-100
                                text-red-700
                                text-sm font-semibold
                            ">

                                Ditangguhkan

                            </span>

                        @else

                            <span class="
                                px-4 py-2
                                rounded-2xl
                                bg-green-100
                                text-green-700
                                text-sm font-semibold
                            ">

                                Aktif

                            </span>

                        @endif


                        <!-- ID -->
                        <span class="
                            px-4 py-2
                            rounded-2xl
                            bg-white/10
                            text-sm
                        ">

                            #{{ $user->kode }}

                        </span>

                    </div>

                </div>

            </div>


            <!-- ACTION -->
            <div>

                <button
                    @click="openSuspend = true"
                    class="
                        bg-red-500
                        hover:bg-red-600
                        text-white
                        px-6 py-4
                        rounded-2xl
                        text-sm font-semibold
                        transition
                        shadow-sm
                    "
                >

                    Tangguhkan Akun

                </button>

            </div>

        </div>

    </div>


    <!-- ================= CONTENT ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- ================= LEFT ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <!-- HEADER -->
            <div class="mb-6">

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Informasi Akun
                </h3>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Informasi login dan kontak pengguna.
                </p>

            </div>


            <!-- CONTENT -->
            <div class="space-y-4">

                <!-- EMAIL -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Email
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                        break-all
                    ">
                        {{ $user->email }}
                    </p>

                </div>


                <!-- PHONE -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Telepon
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $user->phone ?? '-' }}
                    </p>

                </div>


                <!-- ADDRESS -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Alamat
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                        leading-relaxed
                    ">
                        {{ $user->address ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        <!-- ================= RIGHT ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <!-- HEADER -->
            <div class="
                flex flex-col sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4
                mb-6
            ">

                <div>

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Identitas Diri
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Informasi pribadi pengguna.
                    </p>

                </div>


                <!-- KTP -->
                @if($user->ktp)

                    <a href="{{ asset('storage/'.$user->ktp) }}"
                       target="_blank"
                       class="
                            inline-flex items-center justify-center
                            border border-blue-200
                            hover:bg-blue-50
                            text-blue-600
                            px-4 py-2
                            rounded-2xl
                            text-sm font-medium
                            transition
                       ">

                        Lihat Bukti KTP

                    </a>

                @endif

            </div>


            <!-- CONTENT -->
            <div class="space-y-4">

                <!-- NIK -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        NIK
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $user->nik ?? '-' }}
                    </p>

                </div>


                <!-- NAME -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Nama Lengkap
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $user->name }}
                    </p>

                </div>


                <!-- GENDER -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Jenis Kelamin
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">

                        {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}

                    </p>

                </div>


                <!-- BIRTH -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Tanggal Lahir
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">

                        {{ $user->birth_date ?? '-' }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= MODAL SUSPEND ================= -->
    <div
        x-show="openSuspend"
        x-transition
        x-cloak
        class="
            fixed inset-0
            z-50
            bg-black/50
            backdrop-blur-sm
            flex items-center justify-center
            p-4
        "
    >

        <div
            @click.away="openSuspend = false"
            class="
                bg-white
                w-full
                max-w-2xl
                rounded-3xl
                shadow-2xl
                overflow-hidden
            "
        >

            <!-- HEADER -->
            <div class="
                bg-gradient-to-r from-red-500 to-red-600
                p-6
                text-white
            ">

                <div class="
                    flex items-center
                    gap-4
                ">

                    <div class="
                        w-14 h-14
                        rounded-2xl
                        bg-white/20
                        flex items-center justify-center
                        text-2xl
                    ">
                        ⚠️
                    </div>

                    <div>

                        <h2 class="
                            text-xl
                            font-bold
                        ">
                            Penangguhan Akun
                        </h2>

                        <p class="
                            text-sm
                            text-red-100
                            mt-1
                        ">
                            Akses pengguna akan dibatasi sementara.
                        </p>

                    </div>

                </div>

            </div>


            <!-- BODY -->
            <form method="POST"
                  action="{{ route('superadmin.pengguna.suspend', $user->id) }}"
                  class="p-6 space-y-6">

                @csrf

                <!-- WARNING -->
                <div class="
                    bg-yellow-50
                    border border-yellow-200
                    rounded-2xl
                    p-4
                    text-sm
                    text-yellow-700
                ">

                    Pastikan keputusan ini sudah dipertimbangkan sebelum melanjutkan proses penangguhan akun.

                </div>


                <!-- REASON -->
                <div>

                    <h3 class="
                        font-semibold
                        text-gray-800
                        mb-4
                    ">
                        Alasan Penangguhan
                    </h3>


                    <div class="
                        grid grid-cols-1
                        md:grid-cols-2
                        gap-3
                    ">

                        @foreach([
                            'pelecehan' => 'Pelecehan Seksual',
                            'penghinaan' => 'Penghinaan',
                            'tidak_sopan' => 'Perilaku Tidak Sopan',
                            'kekerasan' => 'Tindak Kekerasan',
                            'mengabaikan' => 'Mengabaikan Peringatan'
                        ] as $value => $label)

                        <label class="cursor-pointer">

                            <input
                                type="radio"
                                name="reason"
                                value="{{ $value }}"
                                class="hidden peer"
                            >

                            <div class="
                                border border-gray-200
                                rounded-2xl
                                p-4
                                text-sm
                                font-medium
                                text-gray-600
                                transition
                                hover:border-red-300
                                peer-checked:bg-red-500
                                peer-checked:border-red-500
                                peer-checked:text-white
                            ">

                                {{ $label }}

                            </div>

                        </label>

                        @endforeach

                    </div>

                </div>


                <!-- NOTE -->
                <div>

                    <div class="
                        flex items-center justify-between
                        mb-2
                    ">

                        <h3 class="
                            font-semibold
                            text-gray-800
                        ">
                            Catatan Tambahan
                        </h3>

                        <span class="
                            text-xs
                            text-gray-400
                        "
                              x-data="{ count: 0 }">

                        </span>

                    </div>


                    <textarea
                        name="note"
                        maxlength="500"
                        x-data="{ count: 0 }"
                        @input="count = $event.target.value.length"
                        placeholder="Tuliskan detail alasan penangguhan..."
                        class="
                            w-full
                            border border-gray-200
                            rounded-2xl
                            p-4
                            text-sm
                            focus:ring-2 focus:ring-red-400
                            outline-none
                            min-h-[120px]
                        "
                    ></textarea>


                    <div class="
                        text-right
                        text-xs
                        text-gray-400
                        mt-2
                    ">

                        <span x-text="count"></span>/500

                    </div>

                </div>


                <!-- DURATION -->
                <div>

                    <h3 class="
                        font-semibold
                        text-gray-800
                        mb-4
                    ">
                        Durasi Penangguhan
                    </h3>


                    <div class="
                        grid grid-cols-2
                        md:grid-cols-4
                        gap-3
                    ">

                        @foreach([
                            '7' => '7 Hari',
                            '14' => '14 Hari',
                            '30' => '30 Hari',
                            'permanent' => 'Permanen'
                        ] as $value => $label)

                        <label class="cursor-pointer">

                            <input
                                type="radio"
                                name="duration"
                                value="{{ $value }}"
                                class="hidden peer"
                            >

                            <div class="
                                border border-gray-200
                                rounded-2xl
                                p-4
                                text-center
                                text-sm
                                font-medium
                                text-gray-600
                                transition
                                hover:border-red-300
                                peer-checked:bg-red-500
                                peer-checked:border-red-500
                                peer-checked:text-white
                            ">

                                {{ $label }}

                            </div>

                        </label>

                        @endforeach

                    </div>

                </div>


                <!-- ACTION -->
                <div class="
                    flex flex-col-reverse sm:flex-row
                    justify-end
                    gap-3
                    pt-2
                ">

                    <button
                        type="button"
                        @click="openSuspend = false"
                        class="
                            border border-gray-200
                            hover:bg-gray-50
                            text-gray-600
                            px-6 py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                        "
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="
                            bg-red-500
                            hover:bg-red-600
                            text-white
                            px-6 py-3
                            rounded-2xl
                            text-sm font-semibold
                            transition
                            shadow-sm
                        "
                    >

                        Tangguhkan Akun

                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- ================= RIWAYAT PESANAN ================= -->
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
        ">

            <h3 class="
                text-lg
                font-semibold
                text-gray-800
            ">
                Riwayat Pesanan
            </h3>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Riwayat transaksi pengguna dalam sistem.
            </p>

        </div>


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

                        <h4 class="
                            font-semibold
                            text-gray-800
                        ">
                            {{ $trx->transaction_code }}
                        </h4>

                        <p class="
                            text-sm
                            text-gray-400
                            mt-1
                        ">
                            {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                        </p>

                    </div>


                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        {{ $trx->status_badge }}
                    ">

                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                    </span>

                </div>


                <!-- DETAIL -->
                <div class="
                    grid grid-cols-1
                    gap-3
                    text-sm
                ">

                    <div>

                        <p class="text-gray-400">
                            Layanan
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">

                            @if($trx->services->count())

                                {{ $trx->services->first()->service_name ?? 'Layanan' }}

                                @if($trx->services->count() > 1)

                                    +{{ $trx->services->count()-1 }} lainnya

                                @endif

                            @else

                                -

                            @endif

                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Waktu
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">
                            {{ $trx->service_time }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Total
                        </p>

                        <p class="
                            text-gray-700
                            font-semibold
                        ">
                            {{ $trx->formatted_total_price }}
                        </p>

                    </div>

                </div>

            </div>

            @empty

            <div class="
                p-10
                text-center
            ">

                <p class="
                    text-gray-400
                ">
                    Belum ada riwayat pesanan
                </p>

            </div>

            @endforelse

        </div>


        <!-- DESKTOP -->
        <div class="
            hidden md:block
            overflow-x-auto
        ">

            <table class="min-w-full text-sm">

                <!-- HEADER -->
                <thead class="
                    bg-gray-50
                    text-xs uppercase
                    text-gray-500
                ">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Kode
                        </th>

                        <th class="px-6 py-4 text-left">
                            Layanan
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left">
                            Waktu
                        </th>

                        <th class="px-6 py-4 text-left">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @forelse($transactions as $trx)

                    <tr class="
                        hover:bg-gray-50
                        transition
                    ">

                        <!-- KODE -->
                        <td class="
                            px-6 py-5
                            font-semibold
                            text-gray-700
                        ">

                            {{ $trx->transaction_code }}

                        </td>


                        <!-- SERVICE -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            @if($trx->services->count())

                                {{ $trx->services->first()->service_name ?? 'Layanan' }}

                                @if($trx->services->count() > 1)

                                    +{{ $trx->services->count()-1 }} lainnya

                                @endif

                            @else

                                -

                            @endif

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}

                        </td>


                        <!-- TIME -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $trx->service_time }}

                        </td>


                        <!-- TOTAL -->
                        <td class="
                            px-6 py-5
                            font-semibold
                            text-gray-800
                        ">

                            {{ $trx->formatted_total_price }}

                        </td>


                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{ $trx->status_badge }}
                            ">

                                {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="
                                text-center
                                py-12
                                text-gray-400
                            ">

                            Belum ada riwayat pesanan

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection