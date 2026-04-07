@props([
    'transactions' => [],
    'type' => 'status' // status | complaint
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- ================= SEARCH ================= -->
    <form method="GET"
        class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="{{ $type === 'complaint' ? 'Cari nama, no HP...' : 'Cari ID pesanan, nama pemesan...' }}"
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#4C9A8B] outline-none"
        >

        <div class="flex gap-2">

            <button
                type="submit"
                class="bg-[#4C9A8B] hover:bg-[#3E7F73] text-white px-4 py-2 rounded-lg text-sm font-medium">
                Cari
            </button>

            <button
                type="button"
                class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
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

                    @if($type === 'complaint')
                        <th class="px-4 py-3 text-left">Nomor ID</th>
                        <th class="px-4 py-3 text-left">Nama Pelanggan</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Ponsel</th>
                        <th class="px-4 py-3 text-left">Alasan & Detail Aduan</th>
                    @else
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-center">Jadwal</th>
                        <th class="px-4 py-3 text-center">Jumlah</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    @endif

                </tr>
            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

            @forelse($transactions as $item)

                <tr class="even:bg-gray-50 hover:bg-[#F5FBF9] transition">

                    @if($type === 'complaint')

                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $item->complaint_code }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $item->customer_name }}
                        </td>

                        <td class="px-4 py-3 text-center text-gray-600">
                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3 text-center text-gray-600">
                            {{ $item->phone }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $item->reason }}
                        </td>

                    @else

                        <!-- ID -->
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $item->transaction_code }}
                        </td>

                        <!-- CUSTOMER -->
                        <td class="px-4 py-3 text-gray-600">
                            {{ $item->customer_name }}
                        </td>

                        <!-- JADWAL -->
                        <td class="px-4 py-3 text-center text-gray-600">
                            {{ $item->execution_date ?? '-' }}
                        </td>

                        <!-- JUMLAH -->
                        <td class="px-4 py-3 text-center font-medium">
                            {{ $item->service_count }}
                            <span class="text-gray-400 text-xs">layanan</span>
                        </td>

                        <!-- STATUS -->
                        <td class="px-4 py-3 text-center">

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

                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                {{ ucfirst(str_replace('_',' ',$item->status)) }}
                            </span>

                        </td>

                        <!-- AKSI -->
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('admin.orders.detail',$item->id) }}"
                                   class="px-3 py-1.5 text-xs rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">
                                    Detail
                                </a>

                                <a href="{{ route('admin.orders.edit',$item->id) }}"
                                   class="px-3 py-1.5 text-xs rounded-md bg-green-50 text-green-600 hover:bg-green-100">
                                    Edit
                                </a>

                                <form action="{{ route('admin.orders.delete',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        class="px-3 py-1.5 text-xs rounded-md bg-red-50 text-red-600 hover:bg-red-100">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    @endif

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