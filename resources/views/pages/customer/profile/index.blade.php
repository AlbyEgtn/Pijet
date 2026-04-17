@extends('layouts.customer')

@section('title','Profile')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <div class="absolute inset-0 bg-black/20"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 h-full flex items-center text-white">

        <div>
            <h1 class="text-2xl font-semibold">
                Profil Saya
            </h1>

            <p class="text-sm opacity-80 mt-1">
                Kelola informasi akun Anda
            </p>
        </div>

    </div>

</section>


<div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ================= LEFT ================= -->
    <div class="lg:col-span-2 space-y-6">

        @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
        @endif


        <!-- ================= FORM ================= -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border">

            <h2 class="font-semibold text-gray-800 mb-4">Informasi Pribadi</h2>

            <form action="{{ route('customer.profile.update') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <!-- NAME -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-500">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name',$user->name) }}"
                        class="w-full border px-4 py-3 rounded-xl mt-1">
                </div>

                <!-- EMAIL -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-500">Email</label>
                    <input type="text"
                        value="{{ $user->email }}"
                        class="w-full border px-4 py-3 rounded-xl mt-1 bg-gray-100"
                        disabled>
                </div>

                <!-- PHONE -->
                <div>
                    <label class="text-sm text-gray-500">No HP</label>
                    <input type="text" name="phone"
                        value="{{ old('phone',$user->phone) }}"
                        class="w-full border px-4 py-3 rounded-xl mt-1">
                </div>

                <!-- GENDER -->
                <div>
                    <label class="text-sm text-gray-500">Jenis Kelamin</label>
                    <select name="gender" class="w-full border px-4 py-3 rounded-xl mt-1">
                        <option value="">- Pilih -</option>
                        <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- BIRTH -->
                <div>
                    <label class="text-sm text-gray-500">Tanggal Lahir</label>
                    <input type="date" name="birth_date"
                        value="{{ $user->birth_date }}"
                        class="w-full border px-4 py-3 rounded-xl mt-1">
                </div>

                <!-- ADDRESS -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-500">Alamat</label>
                    <textarea name="address"
                        class="w-full border px-4 py-3 rounded-xl mt-1"
                        rows="3">{{ old('address',$user->address) }}</textarea>
                </div>

                <!-- FOTO -->
                <div>
                    <label class="text-sm text-gray-500">Foto Profil</label>
                    <input type="file" name="foto"
                        class="w-full border px-3 py-2 rounded-xl mt-1 bg-gray-50">
                </div>

                <!-- KTP -->
                <div>
                    <label class="text-sm text-gray-500">Upload KTP</label>
                    <input type="file" name="ktp"
                        class="w-full border px-3 py-2 rounded-xl mt-1 bg-gray-50">
                </div>

                <!-- BUTTON -->
                <div class="md:col-span-2">
                    <button class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>




    </div>


    <!-- ================= RIGHT ================= -->
    <div class="space-y-6">

        <div class="bg-white rounded-2xl shadow-sm p-5 border">
            <h3 class="font-semibold text-gray-800 mb-2">Status Akun</h3>

            <p class="text-sm">
                Verifikasi:
                <span class="
                    {{ $user->verification_status == 'approved' ? 'text-green-600' :
                       ($user->verification_status == 'rejected' ? 'text-red-500' :
                       'text-yellow-600') }}">
                    {{ strtoupper($user->verification_status) }}
                </span>
            </p>

            <p class="text-sm text-gray-500 mt-2">
                Role: {{ $user->role }}
            </p>

        </div>

                <!-- ================= PREVIEW ================= -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border">

            <h2 class="font-semibold text-gray-800 mb-4">Preview Dokumen</h2>

            <div class="flex gap-6">

                <!-- FOTO -->
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-2">Foto</p>
                    @if($user->foto)
                        <img src="{{ asset('storage/'.$user->foto) }}"
                             class="w-20 h-20 rounded-full object-cover">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-full"></div>
                    @endif
                </div>

                <!-- KTP -->
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-2">KTP</p>
                    @if($user->ktp)
                        <img src="{{ asset('storage/'.$user->ktp) }}"
                             class="h-20 object-cover rounded">
                    @else
                        <div class="w-24 h-20 bg-gray-200"></div>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>

@endsection