@props([
    'therapists',
    'mode' => 'list' // list | verify
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 p-4 border-b">

        <input
            type="text"
            name="search"
            placeholder="Cari nama, email, no hp..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#4C9A8B] outline-none"
        >

        <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
            Filter & Sort
        </button>

    </div>


    <!-- ================= TABLE ================= -->
    <div class="overflow-x-auto">

        <table class="min-w-full text-sm table-auto">

            <!-- HEADER -->
            <thead class="bg-[#E7F1EE] text-gray-700 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 w-[100px] text-left">ID</th>
                    <th class="px-4 py-3 w-[180px] text-left">Nama</th>
                    <th class="px-4 py-3 w-[140px] text-center">Gender</th>
                    <th class="px-4 py-3 w-[160px] text-center">No. HP</th>
                    <th class="px-4 py-3 w-[220px] text-left">Email</th>

                    @if($mode == 'verify')
                        <th class="px-4 py-3 w-[140px] text-center">Status</th>
                    @endif

                    <th class="px-4 py-3 w-[200px] text-center">Aksi</th>
                </tr>
            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

            @forelse($therapists as $item)

                <tr class="even:bg-gray-50 hover:bg-[#F5FBF9] transition">

                    <!-- ID -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $item->id }}
                    </td>

                    <!-- NAMA -->
                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->name }}
                    </td>

                    <!-- GENDER -->
                    <td class="px-4 py-3 text-center">
                        <span class="px-2 py-1 rounded-md text-xs bg-gray-100 text-gray-600">
                            {{ $item->gender ?? '-' }}
                        </span>
                    </td>

                    <!-- PHONE -->
                    <td class="px-4 py-3 text-center text-gray-600">
                        {{ $item->phone }}
                    </td>

                    <!-- EMAIL -->
                    <td class="px-4 py-3 text-gray-600">
                        {{ $item->email }}
                    </td>


                    <!-- STATUS (KHUSUS VERIFY) -->
                    @if($mode == 'verify')
                        <td class="px-4 py-3 text-center">
                            @if($item->verification_status == 'approved')                                
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">
                                    Verified
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-600">
                                    Pending
                                </span>
                            @endif
                        </td>
                    @endif


                    <!-- AKSI -->
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">

                            @if($mode == 'verify')

                                <a href="{{ route('admin.therapist.show', $item->id) }}"
                                class="px-3 py-1.5 text-xs rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">
                                    Detail
                                </a>

                            @endif

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

    </div>


    <!-- ================= FOOTER ================= -->
    <div class="flex items-center justify-between p-4 border-t text-sm text-gray-500">

        <span>
            Menampilkan {{ $therapists->count() }} data
        </span>

        <div>
            {{ $therapists->links() }}
        </div>

    </div>

</div>