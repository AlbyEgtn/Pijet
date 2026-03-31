@props([
    'transactions',
    'type' => 'status'
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- ================= SEARCH ================= -->
    <form method="GET"
        class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari ID pesanan, nama pemesan..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#4C9A8B] outline-none"
        >

        <div class="flex gap-2">

            <button
                type="submit"
                class="bg-[#4C9A8B] hover:bg-[#3E7F73] text-white px-4 py-2 rounded-lg text-sm font-medium"
            >
                Cari
            </button>

            <button
                type="button"
                class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm"
            >
                Filter
            </button>

        </div>

    </form>


    <!-- ================= TABLE ================= -->
    <div class="overflow-x-auto">

        <table class="min-w-full text-sm table-auto">

            <!-- HEADER -->
            <thead class="bg-[#E7F1EE] text-gray-700 text-xs uppercase tracking-wide sticky top-0">

                <tr>
                    <th class="px-4 py-3 w-[160px] text-left">ID</th>
                    <th class="px-4 py-3 w-[180px] text-left">Customer</th>
                    <th class="px-4 py-3 w-[160px] text-center">Jadwal</th>
                    <th class="px-4 py-3 w-[140px] text-center">Jumlah</th>
                    <th class="px-4 py-3 w-[140px] text-center">Status</th>
                    <th class="px-4 py-3 w-[180px] text-center">Aksi</th>
                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

            @forelse($transactions as $trx)

                <tr class="even:bg-gray-50 hover:bg-[#F5FBF9] transition">

                    <!-- ID -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $trx->transaction_code }}
                    </td>

                    <!-- CUSTOMER -->
                    <td class="px-4 py-3 text-gray-600">
                        {{ $trx->customer_name }}
                    </td>

                    <!-- JADWAL -->
                    <td class="px-4 py-3 text-center text-gray-600">
                        {{ $trx->execution_date ?? '-' }}
                    </td>

                    <!-- JUMLAH -->
                    <td class="px-4 py-3 text-center font-medium">
                        {{ $trx->service_count }}
                        <span class="text-gray-400 text-xs">layanan</span>
                    </td>

                    <!-- STATUS -->
                    <td class="px-4 py-3 text-center">

                        @php
                            $statusClass = match($trx->status) {
                                'lunas' => 'bg-green-100 text-green-600',
                                'proses' => 'bg-blue-100 text-blue-600',
                                'belum_lunas' => 'bg-gray-100 text-gray-600',
                                'dibatalkan' => 'bg-red-100 text-red-600',
                                'reschedule' => 'bg-yellow-100 text-yellow-600',
                                default => 'bg-gray-100 text-gray-500'
                            };
                        @endphp

                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                            {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                        </span>

                    </td>


                    <!-- AKSI -->
                    <td class="px-4 py-3">

                        <div class="flex items-center justify-center gap-2">

                            <!-- DETAIL -->
                            <a href="{{ route('admin.orders.detail',$trx->id) }}"
                               class="px-3 py-1.5 text-xs font-medium rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">
                                Detail
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.orders.edit',$trx->id) }}"
                               class="px-3 py-1.5 text-xs font-medium rounded-md bg-green-50 text-green-600 hover:bg-green-100">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.orders.delete',$trx->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-red-50 text-red-600 hover:bg-red-100"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-400">
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