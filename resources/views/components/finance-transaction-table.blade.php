@props([
'transactions',
'type' => 'cash'
])

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

    <!-- ================= SEARCH ================= -->
<form method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-5 border-b bg-gray-50">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nomor id, nama, kota, dll..."
        class="w-full md:w-1/2 px-4 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-teal-500 outline-none transition"
    >

    <div class="flex gap-2">

        <button
            type="submit"
            class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2.5 rounded-xl text-sm shadow-sm"
        >
            🔍 Cari
        </button>

        <button
            type="button"
            class="bg-white border hover:bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl text-sm"
        >
            Filter
        </button>

    </div>

</form>


<!-- ================= TABLE ================= -->
<div class="overflow-x-auto">

    <table class="min-w-full text-sm">

        <!-- HEADER -->
        <thead class="bg-slate-100 text-gray-600 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Nomor ID</th>
                <th class="px-5 py-3 text-left">Customer</th>
                <th class="px-5 py-3 text-center">Layanan</th>
                <th class="px-5 py-3 text-center">Terapis</th>
                <th class="px-5 py-3 text-right">Total</th>
                <th class="px-5 py-3 text-center">Tanggal</th>
                <th class="px-5 py-3 text-center">Metode</th>

                @if($type == 'reschedule')
                    <th class="px-5 py-3 text-center">Reschedule</th>
                @endif

                @if($type == 'cancel')
                    <th class="px-5 py-3 text-center">Refund</th>
                @endif

                <th class="px-5 py-3 text-center">Status</th>
                <th class="px-5 py-3 text-center">Aksi</th>
            </tr>
        </thead>


        <!-- BODY -->
        <tbody class="divide-y">

        @forelse($transactions as $trx)

            <tr class="hover:bg-slate-50 transition duration-150">

                <!-- ID -->
                <td class="px-5 py-4 font-semibold text-gray-800">
                    {{ $trx->transaction_code }}
                </td>

                <!-- CUSTOMER -->
                <td class="px-5 py-4 text-gray-600">
                    {{ $trx->customer_name }}
                </td>

                <!-- LAYANAN -->
                <td class="px-5 py-4 text-center">
                    <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                        {{ $trx->service_count }}
                    </span>
                </td>

                <!-- TERAPIS -->
                <td class="px-5 py-4 text-center">
                    <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                        {{ $trx->therapist_filled }}
                    </span>
                </td>

                <!-- TOTAL -->
                <td class="px-5 py-4 text-right font-semibold text-gray-800">
                    Rp{{ number_format($trx->total_price) }}
                </td>

                <!-- TANGGAL -->
                <td class="px-5 py-4 text-center text-gray-600">
                    {{ $trx->execution_date }}
                </td>

                <!-- METODE -->
                <td class="px-5 py-4 text-center">
                    <span class="px-2 py-1 rounded-lg text-xs font-medium
                        {{ $trx->payment_method == 'transfer' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                        {{ ucfirst($trx->payment_method) }}
                    </span>
                </td>


                {{-- RESCHEDULE --}}
                @if($type == 'reschedule')
                    <td class="px-5 py-4 text-center text-gray-600">
                        {{ $trx->reschedule_date ?? '-' }}
                    </td>
                @endif


                {{-- REFUND --}}
                @if($type == 'cancel')
                    <td class="px-5 py-4 text-center">
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
                <td class="px-5 py-4 text-center">
                    @php
                        $statusClass = match($trx->status) {
                            'lunas' => 'bg-green-100 text-green-600',
                            'belum_lunas' => 'bg-yellow-100 text-yellow-600',
                            'dibatalkan' => 'bg-red-100 text-red-600',
                            'reschedule' => 'bg-blue-100 text-blue-600',
                            default => 'bg-gray-100 text-gray-500'
                        };
                    @endphp

                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                    </span>
                </td>


                <!-- AKSI -->
                <td class="px-5 py-4 text-center">
                    <a
                        href="{{ route('finance.transaction.detail',$trx->id) }}"
                        class="inline-flex items-center gap-1 text-teal-600 hover:text-teal-800 text-xs font-semibold"
                    >
                        Detail →
                    </a>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="10" class="text-center p-8 text-gray-400">
                    Data tidak ditemukan
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>


<!-- ================= PAGINATION ================= -->
<div class="p-4 border-t bg-gray-50">
    {{ $transactions->links() }}
</div>

</div>
