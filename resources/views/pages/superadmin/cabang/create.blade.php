@extends('layouts.superadmin')

@section('title','Tambahkan Cabang')

@section('content')

<div class="p-8">

    {{-- BREADCRUMB --}}
    <div class="text-sm text-gray-500 mb-6">

        Cabang
        <span class="text-green-600"> > Tambahkan Cabang</span>

    </div>



    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-6">

        <a href="{{ route('superadmin.cabang.index') }}"
           class="text-gray-600">

            ←

        </a>

        <h2 class="text-lg font-semibold">
            Tambahkan Cabang
        </h2>

    </div>



    {{-- FORM CARD --}}
    <div class="bg-white p-8 rounded-xl shadow max-w-xl">

        <h3 class="font-semibold mb-6">
            Buat Cabang Baru
        </h3>


        <form action="{{ route('superadmin.cabang.store') }}"
              method="POST">

            @csrf


            <div class="space-y-5">

                {{-- KOTA --}}
                <div>

                    <label class="text-sm font-medium">
                        Kota Cabang
                    </label>

                    <input type="text"
                           name="kota"
                           placeholder="Maksimal 50 karakter"
                           class="w-full border rounded-lg p-2 mt-1">

                </div>



                {{-- PROVINSI --}}
                <div>

                    <label class="text-sm font-medium">
                        Provinsi Cabang
                    </label>

                    <input type="text"
                           name="provinsi"
                           placeholder="Maksimal 50 karakter"
                           class="w-full border rounded-lg p-2 mt-1">

                </div>



                {{-- DETAIL LOKASI --}}
                <div>

                    <label class="text-sm font-medium">
                        Detail Lokasi Cabang
                    </label>

                    <input type="text"
                           name="detail_lokasi"
                           placeholder="Masukan detail lokasi cabang"
                           class="w-full border rounded-lg p-2 mt-1">

                </div>



                {{-- EMAIL --}}
                <div>

                    <label class="text-sm font-medium">
                        Email Cabang
                    </label>

                    <input type="email"
                           name="email"
                           placeholder="Tambahkan alamat E-mail cabang"
                           class="w-full border rounded-lg p-2 mt-1">

                </div>
                <div>

                    <label class="text-sm font-medium">
                        Tanggal Peresmian
                    </label>

                    <input
                        type="date"
                        name="tanggal_peresmian"
                        class="w-full border rounded-lg p-2 mt-1"
                        required>

                </div>


                {{-- DESKRIPSI --}}
                <div>

                    <label class="text-sm font-medium">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        placeholder="Penulisan dibatasi hingga 512 karakter"
                        class="w-full border rounded-lg p-2 mt-1 h-24"></textarea>

                </div>



                {{-- BUTTON --}}
                <div class="flex justify-end">

                    <button
                        class="bg-teal-600 text-white px-6 py-2 rounded-lg">

                        Tambahkan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection