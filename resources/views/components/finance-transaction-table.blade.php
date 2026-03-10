@props([
    'transactions',
    'type' => 'cash'
])

<div class="bg-white rounded-xl shadow">

    <!-- SEARCH -->
    <form method="GET" class="flex justify-between items-center p-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nomor id, nama, kota, dll"
            class="w-1/2 px-4 py-2 border rounded-lg text-sm"
        >

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-teal-500 text-white px-4 py-2 rounded-lg"
            >
                🔍
            </button>

            <button
                type="button"
                class="bg-teal-600 text-white px-4 py-2 rounded-lg"
            >
                Filter
            </button>

        </div>

    </form>


    <!-- TABLE -->
    <table class="w-full text-sm">

        <thead class="bg-blue-200 text-gray-700">

            <tr>

                <th class="p-3 text-left">Nomor ID</th>

                <th class="p-3 text-left">Nama Customer</th>

                <th class="p-3 text-center">Jumlah Layanan</th>

                <th class="p-3 text-center">Terisi Terapis</th>

                <th class="p-3 text-center">Total Harga</th>

                <th class="p-3 text-center">Tanggal Pelaksanaan</th>

                <th class="p-3 text-center">Metode Pembayaran</th>


                {{-- KHUSUS RESCHEDULE --}}
                @if($type == 'reschedule')

                    <th class="p-3 text-center">Reschedule</th>

                @endif


                {{-- KHUSUS DIBATALKAN --}}
                @if($type == 'cancel')

                    <th class="p-3 text-center">Ket. Refund</th>

                @endif


                <th class="p-3 text-center">Status</th>

                <th class="p-3 text-center"></th>

            </tr>

        </thead>


        <tbody class="divide-y">

        @forelse($transactions as $trx)

            <tr class="hover:bg-gray-50">

                <!-- NOMOR ID -->
                <td class="p-3">
                    {{ $trx->transaction_code }}
                </td>


                <!-- CUSTOMER -->
                <td class="p-3">
                    {{ $trx->customer_name }}
                </td>


                <!-- JUMLAH LAYANAN -->
                <td class="p-3 text-center">
                    {{ $trx->service_count }}
                </td>


                <!-- TERISI TERAPIS -->
                <td class="p-3 text-center">
                    {{ $trx->therapist_filled }}
                </td>


                <!-- TOTAL HARGA -->
                <td class="p-3 text-center">
                    Rp{{ number_format($trx->total_price) }}
                </td>


                <!-- TANGGAL -->
                <td class="p-3 text-center">
                    {{ $trx->execution_date }}
                </td>


                <!-- METODE PEMBAYARAN -->
                <td class="p-3 text-center">
                    {{ ucfirst($trx->payment_method) }}
                </td>


                {{-- KOLOM RESCHEDULE --}}
                @if($type == 'reschedule')

                    <td class="p-3 text-center">
                        {{ $trx->reschedule_date ?? '-' }}
                    </td>

                @endif


                {{-- KOLOM REFUND --}}
                @if($type == 'cancel')

                    <td class="p-3 text-center">

                        @if($trx->refund_status == 'success')

                            <span class="px-3 py-1 rounded-full text-xs bg-blue-500 text-white">
                                Refund Sukses
                            </span>

                        @elseif($trx->refund_status == 'pending')

                            <span class="px-3 py-1 rounded-full text-xs bg-gray-400 text-white">
                                Belum Refund
                            </span>

                        @else
                            -
                        @endif

                    </td>

                @endif


                <!-- STATUS -->
                <td class="p-3 text-center">

                    @php
                        $statusClass = match($trx->status) {
                            'lunas' => 'bg-blue-500 text-white',
                            'belum_lunas' => 'bg-gray-400 text-white',
                            'dibatalkan' => 'bg-red-500 text-white',
                            'reschedule' => 'bg-green-500 text-white',
                            default => 'bg-gray-300'
                        };
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs {{ $statusClass }}">
                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                    </span>

                </td>


                <!-- DETAIL -->
                <td class="p-3 text-center">

                    <a
                        href="{{ route('finance.transaction.detail',$trx->id) }}"
                        class="text-blue-500 text-xs"
                    >
                        Detail
                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="10" class="text-center p-6 text-gray-400">
                    Data tidak ditemukan
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>


    <!-- PAGINATION -->
    <div class="p-4">
        {{ $transactions->links() }}
    </div>

</div>