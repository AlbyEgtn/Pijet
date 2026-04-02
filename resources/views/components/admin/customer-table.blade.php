@props([
    'data' => []
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- ================= SEARCH ================= -->
    <form method="GET"
        class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama pelanggan atau nomor HP..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#4C9A8B] outline-none"
        >

        <button
            type="submit"
            class="bg-[#4C9A8B] hover:bg-[#3E7F73] text-white px-4 py-2 rounded-lg text-sm">
            Cari
        </button>

    </form>


    <!-- ================= TABLE ================= -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm table-auto">

            <!-- HEADER -->
            <thead class="bg-[#E7F1EE] text-gray-700 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-center">No HP</th>
                    <th class="px-4 py-3 text-center">Total Transaksi</th>
                    <th class="px-4 py-3 text-center">Terakhir Order</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

            @forelse($data as $item)

                <tr class="even:bg-gray-50 hover:bg-[#F5FBF9] transition">

                    <!-- NAMA -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $item->customer_name }}
                    </td>

                    <!-- PHONE -->
                    <td class="px-4 py-3 text-center text-gray-600">
                        {{ $item->customer_phone }}
                    </td>

                    <!-- TOTAL TRANSAKSI -->
                    <td class="px-4 py-3 text-center font-medium">
                        {{ $item->total_transactions ?? 0 }}
                    </td>

                    <!-- LAST ORDER -->
                    <td class="px-4 py-3 text-center text-gray-600">
                        {{ $item->last_order 
                            ? \Carbon\Carbon::parse($item->last_order)->format('d M Y') 
                            : '-' }}
                    </td>

                    <!-- AKSI -->
                    <td class="px-4 py-3 text-center">

                        <a href="{{ route('admin.customer.detail', $item->customer_phone) }}"
                           class="px-3 py-1.5 text-xs rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">
                            Detail
                        </a>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-400">
                        Data pelanggan tidak ditemukan
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>
    </div>


    <!-- ================= PAGINATION ================= -->
    <div class="p-4 border-t">
        {{ $data->links() }}
    </div>

</div>