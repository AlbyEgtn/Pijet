@extends('layouts.superadmin')

@section('title','Cabang')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow-sm">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-semibold text-gray-700">
            Data Daftar Cabang
        </h2>

        <a href="{{ route('superadmin.cabang.create') }}"
           class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>

            </svg>

            Tambahkan Cabang

        </a>

    </div>



    {{-- SEARCH + FILTER --}}
    <div class="flex justify-between items-center mb-6">

        <form method="GET" class="flex">

            <div class="flex">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari nomor id, nama, kota, dll"
                    value="{{ request('search') }}"
                    class="w-80 px-4 py-2 border border-gray-200 rounded-l-lg focus:outline-none"
                >

                <button
                    type="submit"
                    class="bg-[#4C9A8B] px-4 rounded-r-lg flex items-center justify-center text-white">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>

                    </svg>

                </button>

            </div>

        </form>


        {{-- FILTER BUTTON --}}
        <button class="flex items-center gap-2 border px-4 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-50">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 7v5l-4 2v-7L3 6V4z"/>

            </svg>

            Filter

        </button>

    </div>



    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="border-b text-gray-500">

                <tr>

                    <th class="py-3 text-left font-medium">
                        ID Cabang
                    </th>

                    <th class="py-3 text-left font-medium">
                        Kota
                    </th>

                    <th class="py-3 text-left font-medium">
                        Provinsi
                    </th>

                    <th class="py-3 text-left font-medium">
                        Tanggal Peresmian
                    </th>

                    <th class="py-3 text-left font-medium">
                        Status Cabang
                    </th>

                    <th class="py-3 text-left font-medium">
                        Email Cabang
                    </th>

                    <th class="py-3 text-left font-medium">
                        Aksi
                    </th>

                </tr>

            </thead>



            <tbody>

                @foreach ($cabangs as $cabang)

                <tr class="border-b hover:bg-gray-50">

                    <td class="py-4 text-gray-600">
                        {{ $cabang->kode_cabang }}
                    </td>

                    <td>
                        {{ $cabang->kota }}
                    </td>

                    <td>
                        {{ $cabang->provinsi }}
                    </td>

                    <td>
                        {{ $cabang->tanggal_peresmian }}
                    </td>

                    <td>

                        <span class="text-blue-500 font-medium">
                            {{ $cabang->status }}
                        </span>

                    </td>

                    <td class="text-gray-600">
                        {{ $cabang->email }}
                    </td>

                    <td>

                        <div class="flex items-center gap-3">

                            {{-- DETAIL ICON --}}
                            <a href="{{ route('superadmin.cabang.show', $cabang->id) }}"
                               class="text-blue-500 hover:text-blue-600">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15 12H9m12 0A9 9 0 1112 3a9 9 0 019 9z"/>

                                </svg>

                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('superadmin.cabang.delete', $cabang->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="text-red-500 hover:text-red-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>

                                    </svg>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>



    {{-- FOOTER --}}
    <div class="flex justify-between items-center mt-6 text-sm text-gray-500">

        <p>
            Halaman {{ $cabangs->currentPage() }} dari {{ $cabangs->lastPage() }}
        </p>

        {{ $cabangs->links() }}

    </div>

</div>

@endsection