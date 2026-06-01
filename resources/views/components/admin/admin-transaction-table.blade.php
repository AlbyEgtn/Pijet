@props([
    'transactions' => [],
    'type' => 'status' // status | complaint
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

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <!-- TITLE -->
            <div>

                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $type === 'complaint'
                        ? 'Daftar Aduan'
                        : 'Daftar Transaksi'
                    }}
                </h2>

                <p class="text-sm text-gray-400 mt-1">
                    {{ $type === 'complaint'
                        ? 'Monitoring data aduan pelanggan'
                        : 'Monitoring seluruh data transaksi'
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
                    placeholder="{{ $type === 'complaint'
                        ? 'Cari nama, nomor HP...'
                        : 'Cari ID pesanan, nama customer...'
                    }}"
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

        @forelse($transactions as $item)

        <div class="
            p-5
            border-b border-gray-100
            space-y-4
        ">

            @if($type === 'complaint')

                <!-- TOP -->
                <div class="flex items-start justify-between gap-3">

                    <div>

                        <p class="font-semibold text-gray-800">
                            {{ $item->customer_name }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            {{ $item->complaint_code }}
                        </p>

                    </div>


                    <span class="
                        text-xs
                        px-3 py-1.5
                        rounded-full
                        bg-red-100
                        text-red-600
                        whitespace-nowrap
                    ">
                        Aduan
                    </span>

                </div>


                <!-- DETAIL -->
                <div class="space-y-2 text-sm">

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Tanggal
                        </p>

                        <p class="text-gray-700">
                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Nomor HP
                        </p>

                        <p class="text-gray-700">
                            {{ $item->phone }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Detail Aduan
                        </p>

                        <p class="text-gray-700 leading-relaxed">
                            {{ $item->reason }}
                        </p>

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
                <div class="flex items-start justify-between gap-3">

                    <div>

                        <p class="font-semibold text-gray-800">
                            {{ $item->customer_name }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            {{ $item->transaction_code }}
                        </p>

                    </div>


                    <span class="
                        inline-flex items-center
                        px-3 py-1.5
                        text-xs font-medium
                        rounded-full
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

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Jadwal
                        </p>

                        <p class="text-gray-700">
                            {{ $item->execution_date ?? '-' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Layanan
                        </p>

                        <p class="text-gray-700">
                            {{ $item->service_count }}
                        </p>

                    </div>

                </div>


                <!-- ACTION -->
                <div class="
                    flex flex-col
                    gap-2
                    pt-2
                ">

                    <a href="{{ route('admin.orders.detail',$item->id) }}"
                        class="
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

                        Detail

                    </a>


                    <div class="grid grid-cols-2 gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('admin.orders.edit',$item->id) }}"
                            class="
                                text-center
                                bg-green-50
                                text-green-600
                                py-3
                                rounded-2xl
                                text-sm font-medium
                                hover:bg-green-100
                                transition
                            ">

                            Edit

                        </a>


                        <!-- DELETE -->
                        <form action="{{ route('admin.orders.delete',$item->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin hapus data ini?')"
                                class="
                                    w-full
                                    bg-red-50
                                    text-red-600
                                    py-3
                                    rounded-2xl
                                    text-sm font-medium
                                    hover:bg-red-100
                                    transition
                                "
                            >

                                Hapus

                            </button>

                        </form>

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

                    @if($type === 'complaint')

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
                            Detail Aduan
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
                            Jumlah
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Aksi
                        </th>

                    @endif

                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($transactions as $item)

                <tr class="hover:bg-gray-50 transition">

                    @if($type === 'complaint')

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->complaint_code }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->customer_name }}
                        </td>

                        <td class="px-6 py-4 text-center text-gray-500">
                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center text-gray-500">
                            {{ $item->phone }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->reason }}
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
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->transaction_code }}
                        </td>

                        <!-- CUSTOMER -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->customer_name }}
                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-4 text-center text-gray-500">
                            {{ $item->execution_date ?? '-' }}
                        </td>

                        <!-- COUNT -->
                        <td class="px-6 py-4 text-center font-medium text-gray-700">
                            {{ $item->service_count }}

                            <span class="text-xs text-gray-400">
                                layanan
                            </span>

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4 text-center">

                            <span class="
                                inline-flex items-center
                                px-3 py-1.5
                                text-xs font-medium
                                rounded-full
                                {{ $statusClass }}
                            ">

                                {{ ucfirst(str_replace('_',' ',$item->status)) }}

                            </span>

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <!-- DETAIL -->
                                <a href="{{ route('admin.orders.detail',$item->id) }}"
                                    class="
                                        px-3 py-2
                                        rounded-xl
                                        text-xs font-medium
                                        bg-blue-50
                                        text-blue-600
                                        hover:bg-blue-100
                                        transition
                                    ">

                                    Detail

                                </a>


                                <!-- EDIT -->
                                <a href="{{ route('admin.orders.edit',$item->id) }}"
                                    class="
                                        px-3 py-2
                                        rounded-xl
                                        text-xs font-medium
                                        bg-green-50
                                        text-green-600
                                        hover:bg-green-100
                                        transition
                                    ">

                                    Edit

                                </a>


                                <!-- DELETE -->
                                <form action="{{ route('admin.orders.delete',$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        class="
                                            px-3 py-2
                                            rounded-xl
                                            text-xs font-medium
                                            bg-red-50
                                            text-red-600
                                            hover:bg-red-100
                                            transition
                                        "
                                    >

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    @endif

                </tr>

                @empty

                <tr>

                    <td colspan="6"
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

        {{ $transactions->links() }}

    </div>

</div>