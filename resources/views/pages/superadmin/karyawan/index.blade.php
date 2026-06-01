@extends('layouts.superadmin')

@section('title','Karyawan')
@section('header','Karyawan')

@section('content')

<div class="space-y-6">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
        flex flex-col lg:flex-row
        lg:items-center
        lg:justify-between
        gap-6
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-56 h-56
            bg-white/10
            rounded-full
            blur-3xl
        "></div>


        <div class="relative z-10">

            <p class="
                text-sm
                text-teal-100
                mb-2
            ">
                Kelola Karyawan
            </p>

            <h2 class="
                text-2xl md:text-4xl
                font-bold
            ">
                Data Akun Karyawan
            </h2>

            <p class="
                text-sm md:text-base
                text-teal-100
                mt-3
                max-w-2xl
            ">
                Kelola seluruh akun admin dan finance dalam sistem.
            </p>

        </div>


        <!-- BUTTON -->
        <a href="{{ route('superadmin.karyawan.create') }}"
           class="
                relative z-10
                inline-flex items-center justify-center
                bg-white
                hover:bg-gray-100
                text-teal-700
                px-5 py-3
                rounded-2xl
                text-sm font-semibold
                transition
                shadow-sm
           ">

            + Buat Akun Baru

        </a>

    </div>


    <!-- ================= FILTER ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-5 md:p-6
        space-y-5
    ">

        <!-- TOP -->
        <div class="
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-5
        ">

            <!-- ROLE TAB -->
            <div class="
                flex items-center
                gap-3
                overflow-x-auto
            ">

                <!-- ADMIN -->
                <a href="{{ route('superadmin.karyawan.index', ['role'=>'admin']) }}"
                   class="
                        whitespace-nowrap
                        px-5 py-3
                        rounded-2xl
                        text-sm font-medium
                        transition
                        {{
                            $role == 'admin'
                            ? 'bg-teal-600 text-white shadow-sm'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                        }}
                   ">

                    Admin

                </a>


                <!-- FINANCE -->
                <a href="{{ route('superadmin.karyawan.index', ['role'=>'finance']) }}"
                   class="
                        whitespace-nowrap
                        px-5 py-3
                        rounded-2xl
                        text-sm font-medium
                        transition
                        {{
                            $role == 'finance'
                            ? 'bg-teal-600 text-white shadow-sm'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                        }}
                   ">

                    Finance

                </a>

            </div>


            <!-- TOTAL -->
            <div class="
                text-sm
                text-gray-500
            ">

                Total Karyawan:
                <span class="
                    font-semibold
                    text-gray-800
                ">
                    {{ $karyawans->total() }}
                </span>

            </div>

        </div>


        <!-- SEARCH -->
        <form method="GET"
              class="
                flex flex-col md:flex-row
                gap-3
              ">

            <input
                type="hidden"
                name="role"
                value="{{ $role }}"
            >

            <!-- INPUT -->
            <div class="
                relative
                flex-1
            ">

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari nama atau ID karyawan..."
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        pr-12
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

                <!-- ICON -->
                <div class="
                    absolute right-4 top-1/2
                    -translate-y-1/2
                    text-gray-400
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>

                    </svg>

                </div>

            </div>


            <!-- BUTTON -->
            <button class="
                bg-teal-600
                hover:bg-teal-700
                text-white
                px-6 py-3
                rounded-2xl
                text-sm font-semibold
                transition
            ">

                Cari

            </button>

        </form>

    </div>


    <!-- ================= MAIN CARD ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        overflow-hidden
    ">

        <!-- HEADER -->
        <div class="
            px-6 py-5
            border-b border-gray-100
            flex items-center justify-between
        ">

            <div>

                <h2 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Daftar Karyawan
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Data akun karyawan terdaftar
                </p>

            </div>

        </div>


        <!-- ================= MOBILE CARD ================= -->
        <div class="block md:hidden">

            @forelse($karyawans as $karyawan)

            <div class="
                p-5
                border-b border-gray-100
                space-y-4
            ">

                <!-- TOP -->
                <div class="
                    flex items-start justify-between
                    gap-4
                ">

                    <!-- USER -->
                    <div class="
                        flex items-center
                        gap-3
                    ">

                        <!-- AVATAR -->
                        <div class="
                            w-12 h-12
                            rounded-2xl
                            bg-teal-100
                            text-teal-700
                            flex items-center justify-center
                            font-bold
                        ">

                            {{ strtoupper(substr($karyawan->name,0,1)) }}

                        </div>


                        <!-- INFO -->
                        <div>

                            <h3 class="
                                font-semibold
                                text-gray-800
                            ">
                                {{ $karyawan->name }}
                            </h3>

                            <p class="
                                text-sm
                                text-gray-400
                            ">
                                {{ $karyawan->kode }}
                            </p>

                        </div>

                    </div>


                    <!-- ROLE -->
                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        {{
                            $karyawan->role == 'admin'
                            ? 'bg-blue-100 text-blue-600'
                            : 'bg-purple-100 text-purple-600'
                        }}
                    ">

                        {{ ucfirst($karyawan->role) }}

                    </span>

                </div>


                <!-- INFO -->
                <div class="
                    grid grid-cols-1
                    gap-3
                    text-sm
                ">

                    <div>

                        <p class="text-gray-400">
                            Kontak
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">
                            {{ $karyawan->phone ?? '-' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Tanggal Dibuat
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">
                            {{ $karyawan->created_at->format('d M Y') }}
                        </p>

                    </div>

                </div>


                <!-- ACTION -->
                <div class="
                    flex items-center
                    gap-3
                    pt-2
                ">

                    <!-- DETAIL -->
                    <a href="{{ route('superadmin.karyawan.show', $karyawan->id) }}"
                       class="
                            flex-1
                            text-center
                            bg-blue-50
                            hover:bg-blue-100
                            text-blue-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                       ">

                        Detail

                    </a>


                    <!-- DELETE -->
                    <form id="delete-form-mobile-{{ $karyawan->id }}"
                          action="{{ route('superadmin.karyawan.destroy', $karyawan->id) }}"
                          method="POST"
                          class="flex-1">

                        @csrf
                        @method('DELETE')

                        <button type="button"
                                onclick="confirmDelete('mobile-{{ $karyawan->id }}')"
                                class="
                                    w-full
                                    bg-red-50
                                    hover:bg-red-100
                                    text-red-600
                                    py-3
                                    rounded-2xl
                                    text-sm font-medium
                                    transition
                                ">

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

            @empty

            <div class="
                p-10
                text-center
            ">

                <p class="
                    text-gray-400
                ">
                    Tidak ada data karyawan
                </p>

            </div>

            @endforelse

        </div>


        <!-- ================= DESKTOP TABLE ================= -->
        <div class="
            hidden md:block
            overflow-x-auto
        ">

            <table class="min-w-full text-sm">

                <!-- HEADER -->
                <thead class="
                    bg-gray-50
                    text-xs uppercase
                    text-gray-500
                ">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left">
                            Karyawan
                        </th>

                        <th class="px-6 py-4 text-left">
                            Kontak
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left">
                            Role
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @forelse($karyawans as $karyawan)

                    <tr class="
                        hover:bg-gray-50
                        transition
                    ">

                        <!-- ID -->
                        <td class="
                            px-6 py-5
                            font-semibold
                            text-gray-700
                        ">

                            {{ $karyawan->kode }}

                        </td>


                        <!-- USER -->
                        <td class="px-6 py-5">

                            <div class="
                                flex items-center
                                gap-3
                            ">

                                <!-- AVATAR -->
                                <div class="
                                    w-11 h-11
                                    rounded-2xl
                                    bg-teal-100
                                    text-teal-700
                                    flex items-center justify-center
                                    font-bold
                                ">

                                    {{ strtoupper(substr($karyawan->name,0,1)) }}

                                </div>


                                <!-- INFO -->
                                <div>

                                    <p class="
                                        font-semibold
                                        text-gray-800
                                    ">
                                        {{ $karyawan->name }}
                                    </p>

                                    <p class="
                                        text-xs
                                        text-gray-400
                                        mt-1
                                    ">
                                        ID: {{ $karyawan->id }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        <!-- PHONE -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $karyawan->phone ?? '-' }}

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-5
                            text-gray-500
                        ">

                            {{ $karyawan->created_at->format('d M Y') }}

                        </td>


                        <!-- ROLE -->
                        <td class="px-6 py-5">

                            @if($karyawan->role == 'admin')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-blue-100
                                    text-blue-600
                                ">

                                    Admin

                                </span>

                            @elseif($karyawan->role == 'finance')

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-purple-100
                                    text-purple-600
                                ">

                                    Finance

                                </span>

                            @endif

                        </td>


                        <!-- ACTION -->
                        <td class="
                            px-6 py-5
                            text-right
                        ">

                            <div class="
                                flex items-center justify-end
                                gap-3
                            ">

                                <!-- DETAIL -->
                                <a href="{{ route('superadmin.karyawan.show', $karyawan->id) }}"
                                   class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-blue-50
                                        hover:bg-blue-100
                                        text-blue-600
                                        text-sm
                                        transition
                                   ">

                                    Detail

                                </a>


                                <!-- DELETE -->
                                <form id="delete-form-{{ $karyawan->id }}"
                                      action="{{ route('superadmin.karyawan.destroy', $karyawan->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            onclick="confirmDelete({{ $karyawan->id }})"
                                            class="
                                                px-4 py-2
                                                rounded-xl
                                                bg-red-50
                                                hover:bg-red-100
                                                text-red-600
                                                text-sm
                                                transition
                                            ">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="
                                text-center
                                py-12
                                text-gray-400
                            ">

                            Tidak ada data karyawan

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- FOOTER -->
        <div class="
            px-6 py-5
            border-t border-gray-100
        ">

            {{ $karyawans->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection


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