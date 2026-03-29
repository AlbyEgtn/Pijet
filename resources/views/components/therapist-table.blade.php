<div class="bg-white rounded-xl shadow p-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2 w-1/2">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nomor id, nama, email, dll"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-green-200"
            >
            <button class="bg-green-500 text-white px-4 rounded-lg">
                🔍
            </button>
        </form>

        <a href="{{ route('therapist.create') }}" 
           class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm">
            + Tambahkan akun terapis
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-3 py-2">Nomor ID</th>
                    <th class="px-3 py-2">Nama Lengkap</th>
                    <th class="px-3 py-2">Jenis Kelamin</th>
                    <th class="px-3 py-2">Ponsel</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($therapists as $therapist)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $therapist->code }}</td>
                        <td class="px-3 py-2">{{ $therapist->name }}</td>
                        <td class="px-3 py-2">{{ $therapist->gender }}</td>
                        <td class="px-3 py-2">{{ $therapist->phone }}</td>
                        <td class="px-3 py-2">{{ $therapist->email }}</td>
                        <td class="px-3 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('admin.therapist.edit', $therapist->id) }}" 
                               class="text-blue-500">
                                ✏️
                            </a>

                            <form action="{{ route('admin.therapist.destroy', $therapist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" 
                                        class="text-red-500">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $therapists->links() }}
    </div>
</div>