@extends('layouts.superadmin')

@section('title', 'Manajemen Kota')

@section('header', 'Manajemen Kota')

@section('content')

<div x-data="{ openCreate:false }">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>

            <h2 class="text-2xl font-bold text-gray-800">
                Data Kota
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola kota yang tersedia pada sistem
            </p>

        </div>

        <button
            @click="openCreate=true"
            class="
                bg-teal-600
                hover:bg-teal-700
                text-white
                px-5 py-3
                rounded-2xl
                text-sm
                font-medium
                shadow
                transition
            "
        >
            + Tambah Kota
        </button>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Kota
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Provinsi
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($cities as $city)

                    <tr class="border-t border-gray-100 hover:bg-gray-50">

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="font-medium text-gray-800">
                                {{ $city->name }}
                            </div>

                        </td>

                        <td class="px-6 py-4 text-gray-600 text-sm">
                            {{ $city->province_name }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <!-- EDIT -->
                                <button
                                    onclick="openEditModal(
                                        '{{ $city->id }}',
                                        '{{ $city->name }}',
                                        '{{ $city->province_name }}'
                                    )"
                                    class="
                                        px-4 py-2
                                        bg-amber-500
                                        hover:bg-amber-600
                                        text-white
                                        rounded-xl
                                        text-xs
                                    "
                                >
                                    Edit
                                </button>

                                <!-- DELETE -->
                                <form
                                    method="POST"
                                    action="{{ route('cities.destroy',$city) }}"
                                    onsubmit="return confirm('Hapus kota ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="
                                            px-4 py-2
                                            bg-red-500
                                            hover:bg-red-600
                                            text-white
                                            rounded-xl
                                            text-xs
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-6 py-10 text-center text-gray-400"
                        >

                            Belum ada data kota

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="p-6 border-t border-gray-100">

            {{ $cities->links() }}

        </div>

    </div>


    <!-- ================= CREATE MODAL ================= -->
    <div
        x-show="openCreate"
        x-cloak
        class="
            fixed inset-0
            bg-black/40
            flex items-center justify-center
            z-50
            p-4
        "
    >

        <div
            @click.away="openCreate=false"
            class="
                bg-white
                rounded-3xl
                w-full
                max-w-lg
                p-6
            "
        >

            <h3 class="text-xl font-semibold mb-6">
                Tambah Kota
            </h3>

            <form
                method="POST"
                action="{{ route('cities.store') }}"
            >

                @csrf

                <div class="space-y-4">

                    <div>

                        <label class="text-sm text-gray-600">
                            Nama Kota
                        </label>

                        <input
                            type="text"
                            name="name"
                            required
                            class="
                                w-full
                                mt-2
                                border
                                rounded-xl
                                px-4 py-3
                            "
                        >

                    </div>

                    <div>

                        <label class="text-sm text-gray-600">
                            Nama Provinsi
                        </label>

                        <input
                            type="text"
                            name="province_name"
                            required
                            class="
                                w-full
                                mt-2
                                border
                                rounded-xl
                                px-4 py-3
                            "
                        >

                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">

                    <button
                        type="button"
                        @click="openCreate=false"
                        class="
                            px-5 py-3
                            rounded-xl
                            bg-gray-100
                        "
                    >
                        Batal
                    </button>

                    <button
                        class="
                            px-5 py-3
                            rounded-xl
                            bg-teal-600
                            text-white
                        "
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- ================= EDIT MODAL ================= -->
<div
    id="editModal"
    class="
        hidden
        fixed inset-0
        bg-black/40
        z-50
        items-center justify-center
        p-4
    "
>

    <div class="
        bg-white
        rounded-3xl
        w-full
        max-w-lg
        p-6
    ">

        <h3 class="text-xl font-semibold mb-6">
            Edit Kota
        </h3>

        <form
            id="editForm"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>

                    <label class="text-sm text-gray-600">
                        Nama Kota
                    </label>

                    <input
                        type="text"
                        id="editName"
                        name="name"
                        required
                        class="
                            w-full
                            mt-2
                            border
                            rounded-xl
                            px-4 py-3
                        "
                    >

                </div>

                <div>

                    <label class="text-sm text-gray-600">
                        Nama Provinsi
                    </label>

                    <input
                        type="text"
                        id="editProvince"
                        name="province_name"
                        required
                        class="
                            w-full
                            mt-2
                            border
                            rounded-xl
                            px-4 py-3
                        "
                    >

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="
                        px-5 py-3
                        rounded-xl
                        bg-gray-100
                    "
                >
                    Batal
                </button>

                <button
                    class="
                        px-5 py-3
                        rounded-xl
                        bg-teal-600
                        text-white
                    "
                >
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@section('script')

<script>

function openEditModal(id,name,province)
{
    document
        .getElementById('editModal')
        .classList
        .remove('hidden');

    document
        .getElementById('editModal')
        .classList
        .add('flex');

    document
        .getElementById('editName')
        .value = name;

    document
        .getElementById('editProvince')
        .value = province;

    document
        .getElementById('editForm')
        .action = `/superadmin/cities/${id}`;
}

function closeEditModal()
{
    document
        .getElementById('editModal')
        .classList
        .add('hidden');

    document
        .getElementById('editModal')
        .classList
        .remove('flex');
}

</script>

@endsection