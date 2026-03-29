@props([
    'transactions',
    'type' => 'status'
])

<div class="bg-white rounded-xl shadow">

    <!-- SEARCH -->
    <form method="GET" class="flex justify-between items-center p-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari ID pesanan, nama pemesan..."
            class="w-1/2 px-4 py-2 border rounded-lg text-sm"
        >

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-[#4C9A8B] text-white px-4 py-2 rounded-lg"
            >
                🔍
            </button>

            <button
                type="button"
                class="bg-gray-200 px-4 py-2 rounded-lg text-sm"
            >
                Filter
            </button>

        </div>

    </form>


    <!-- TABLE -->
    <table class="w-full text-sm">

        <thead class="bg-[#E7F1EE] text-gray-700">

            <tr>

                <th class="p-3 text-left">ID Pesanan</th>

                <th class="p-3 text-left">Nama Pemesan</th>

                <th class="p-3 text-left">Jenis Layanan</th>

                <th class="p-3 text-center">Jadwal Layanan</th>

                <th class="p-3 text-center">Jumlah Pesanan</th>

                <th class="p-3 text-center">Status</th>

                <th class="p-3 text-center">Aksi</th>

            </tr>

        </thead>


        <tbody class="divide-y">

        @forelse($transactions as $trx)

            <tr class="hover:bg-gray-50">

                <!-- ID -->
                <td class="p-3">
                    {{ $trx->transaction_code }}
                </td>


                <!-- NAMA -->
                <td class="p-3">
                    {{ $trx->customer_name }}
                </td>


                <!-- LAYANAN -->
                <td class="p-3">
                    {{ $trx->service_name }}
                </td>


                <!-- JADWAL -->
                <td class="p-3 text-center">
                    {{ $trx->execution_date }}
                </td>


                <!-- JUMLAH -->
                <td class="p-3 text-center">
                    {{ $trx->service_count }} Orang
                </td>


                <!-- STATUS -->
                <td class="p-3 text-center">

                    @php
                        $statusClass = match($trx->status) {
                            'lunas' => 'bg-green-500 text-white',
                            'proses' => 'bg-blue-500 text-white',
                            'belum_lunas' => 'bg-gray-400 text-white',
                            'dibatalkan' => 'bg-red-500 text-white',
                            'reschedule' => 'bg-yellow-500 text-white',
                            default => 'bg-gray-300'
                        };
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs {{ $statusClass }}">
                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                    </span>

                </td>


                <!-- AKSI -->
                <td class="p-3 text-center">

                    <div class="flex justify-center gap-2">

                        <!-- DETAIL -->
                        <a
                            href="{{ route('admin.orders.detail',$trx->id) }}"
                            class="text-blue-500"
                        >
                            🔍
                        </a>

                        <!-- EDIT -->
                        <a
                            href="{{ route('admin.orders.edit',$trx->id) }}"
                            class="text-green-500"
                        >
                            ✏️
                        </a>

                        <!-- DELETE -->
                        <form
                            action="{{ route('admin.orders.delete',$trx->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500">
                                🗑
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center p-6 text-gray-400">
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