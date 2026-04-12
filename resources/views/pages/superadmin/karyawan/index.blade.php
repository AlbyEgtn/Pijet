@extends('layouts.superadmin')

@section('title','Karyawan')

@section('content')

<div class="p-6 space-y-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h1 class="text-lg font-semibold">Data Akun Karyawan</h1>

        <a href="{{ route('superadmin.karyawan.create') }}"
        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
            + Buat Akun Baru
        </a>
    </div>

    <!-- TAB -->
    <div class="flex gap-2">
        <a href="{{ route('superadmin.karyawan.index', ['role'=>'admin']) }}"
            class="px-4 py-2 rounded {{ $role == 'admin' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            Admin
        </a>

        <a href="{{ route('superadmin.karyawan.index', ['role'=>'finance']) }}"
            class="px-4 py-2 rounded {{ $role == 'finance' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            Finance
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="flex gap-2">
        <input type="hidden" name="role" value="{{ $role }}">

        <input type="text" name="search" value="{{ $search }}"
            placeholder="Cari nama atau ID..."
            class="border px-3 py-2 rounded w-64">

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Cari
        </button>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="text-sm font-semibold text-gray-700">
                Daftar Karyawan
            </h2>

            <span class="text-xs text-gray-400">
                Total: {{ $karyawans->total() }}
            </span>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Karyawan</th>
                        <th class="px-6 py-3 text-left">Kontak</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($karyawans as $karyawan)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- ID -->
                        <td class="px-6 py-4 font-semibold text-gray-700">
                            {{ $karyawan->kode }}
                        </td>

                        <!-- Nama -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                <!-- Avatar -->
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-semibold">
                                    {{ strtoupper(substr($karyawan->name,0,1)) }}
                                </div>

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $karyawan->name }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        ID: {{ $karyawan->id }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Kontak -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ $karyawan->phone ?? '-' }}
                        </td>

                        <!-- Tanggal -->
                        <td class="px-6 py-4 text-gray-500">
                            {{ $karyawan->created_at->format('d M Y') }}
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-4">
                            @if($karyawan->role == 'admin')
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-600">
                                    Admin
                                </span>
                            @elseif($karyawan->role == 'finance')
                                <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-600">
                                    Finance
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('superadmin.karyawan.show', $karyawan->id) }}"
                                class="p-2 rounded-lg hover:bg-blue-50 text-blue-500">
                                👁️
                                </a>

                                <!-- Delete -->
                                <form id="delete-form-{{ $karyawan->id }}"
                                    action="{{ route('superadmin.karyawan.destroy', $karyawan->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="confirmDelete({{ $karyawan->id }})"
                                        class="p-2 rounded-lg hover:bg-red-50 text-red-500">
                                        🗑️
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400">
                            Tidak ada data karyawan
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="px-6 py-4 border-t">
            {{ $karyawans->withQueryString()->links() }}
        </div>

    </div>

    <!-- PAGINATION -->
    <div>
        {{ $karyawans->withQueryString()->links() }}
    </div>

</div>
@section('script')

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
@endsection