@props([
    'transactions',
    'type' => 'cash'
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- ================= SEARCH ================= -->
    <form method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nomor id, nama, kota, dll"
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-teal-500 outline-none"
        >

        <div class="flex gap-2">
            <button
                type="submit"
                class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-lg text-sm"
            >
                Cari
            </button>

            <button
                type="button"
                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm"
            >
                Filter
            </button>
        </div>

    </form>


    <!-- ================= TABLE ================= -->
    <div class="overflow-x-auto">

        <table class="min-w-full text-sm table-auto">

            <!-- HEADER -->
            <thead class="bg-slate-100 text-gray-700 text-xs uppercase tracking-wide sticky top-0 z-10">
                <tr>
                    <th class="px-4 py-3 w-[160px] text-left">Nomor ID</th>
                    <th class="px-4 py-3 w-[180px] text-left">Customer</th>
                    <th class="px-4 py-3 w-[120px] text-center">Layanan</th>
                    <th class="px-4 py-3 w-[120px] text-center">Terapis</th>
                    <th class="px-4 py-3 w-[140px] text-right">Total</th>
                    <th class="px-4 py-3 w-[160px] text-center">Tanggal</th>
                    <th class="px-4 py-3 w-[140px] text-center">Metode</th>

                    @if($type == 'reschedule')
                        <th class="px-4 py-3 w-[160px] text-center">Reschedule</th>
                    @endif

                    @if($type == 'cancel')
                        <th class="px-4 py-3 w-[160px] text-center">Refund</th>
                    @endif

                    <th class="px-4 py-3 w-[140px] text-center">Status</th>
                    <th class="px-4 py-3 w-[100px] text-center">Aksi</th>
                </tr>
            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

            @forelse($transactions as $trx)

                <tr class="even:bg-gray-50 hover:bg-slate-50 transition">

                    <!-- ID -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $trx->transaction_code }}
                    </td>

                    <!-- CUSTOMER -->
                    <td class="px-4 py-3 text-gray-600">
                        {{ $trx->customer_name }}
                    </td>

                    <!-- LAYANAN -->
                    <td class="px-4 py-3 text-center">
                        {{ $trx->service_count }}
                    </td>

                    <!-- TERAPIS -->
                    <td class="px-4 py-3 text-center">
                        {{ $trx->therapist_filled }}
                    </td>

                    <!-- TOTAL -->
                    <td class="px-4 py-3 text-right font-semibold text-gray-800">
                        Rp{{ number_format($trx->total_price) }}
                    </td>

                    <!-- TANGGAL -->
                    <td class="px-4 py-3 text-center text-gray-600">
                        {{ $trx->execution_date }}
                    </td>

                    <!-- METODE -->
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                            {{ ucfirst($trx->payment_method) }}
                        </span>
                    </td>


                    {{-- RESCHEDULE --}}
                    @if($type == 'reschedule')
                        <td class="px-4 py-3 text-center text-gray-600">
                            {{ $trx->reschedule_date ?? '-' }}
                        </td>
                    @endif


                    {{-- REFUND --}}
                    @if($type == 'cancel')
                        <td class="px-4 py-3 text-center">
                            @if($trx->refund_status == 'success')
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-600">
                                    Sukses
                                </span>
                            @elseif($trx->refund_status == 'pending')
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                    Pending
                                </span>
                            @else
                                -
                            @endif
                        </td>
                    @endif


                    <!-- STATUS -->
                    <td class="px-4 py-3 text-center">
                        @php
                            $statusClass = match($trx->status) {
                                'lunas' => 'bg-blue-100 text-blue-600',
                                'belum_lunas' => 'bg-gray-100 text-gray-600',
                                'dibatalkan' => 'bg-red-100 text-red-600',
                                'reschedule' => 'bg-green-100 text-green-600',
                                default => 'bg-gray-100 text-gray-500'
                            };
                        @endphp

                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                            {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                        </span>
                    </td>


                    <!-- AKSI -->
                    <td class="px-4 py-3 text-center">
                        <a
                            href="{{ route('finance.transaction.detail',$trx->id) }}"
                            class="text-teal-600 hover:text-teal-800 text-xs font-medium"
                        >
                            Detail →
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

    </div>


    <!-- ================= PAGINATION ================= -->
    <div class="p-4 border-t">
        {{ $transactions->links() }}
    </div>

</div>