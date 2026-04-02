@props([
    'data' => [],
    'type' => 'transaction' // transaction | report
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- SEARCH -->
    <form method="GET"
        class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama, no HP..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#4C9A8B] outline-none"
        >

        <button class="bg-[#4C9A8B] text-white px-4 py-2 rounded-lg text-sm">
            Cari
        </button>
    </form>


    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">

            <thead class="bg-[#E7F1EE] text-xs uppercase">
                <tr>

                    @if($type === 'report')
                        <th class="px-4 py-3 text-left">Nomor ID</th>
                        <th class="px-4 py-3 text-left">Nama Pelanggan</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Ponsel</th>
                        <th class="px-4 py-3 text-left">Alasan</th>
                    @else
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-center">Jadwal</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    @endif

                </tr>
            </thead>


            <tbody>

            @forelse($data as $item)

                <tr class="border-b hover:bg-gray-50">

                    @if($type === 'report')

                        <td class="px-4 py-3">
                            {{ $item->transaction_code }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->customer_name }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ \Carbon\Carbon::parse($item->service_date)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $item->customer_phone }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->cancel_reason ?? 'Tidak ada keterangan' }}
                        </td>

                    @else

                        <td class="px-4 py-3">
                            {{ $item->transaction_code }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->customer_name }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $item->service_date }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $item->status }}
                        </td>

                    @endif

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-400">
                        Data tidak ditemukan
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>
    </div>

    <div class="p-4">
        {{ $data->links() }}
    </div>

</div>