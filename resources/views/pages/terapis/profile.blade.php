@extends('layouts.terapis')

@section('title','Profile')
@section('header','Profile')

@section('content')

<div class="p-6 max-w-5xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-5 rounded-2xl shadow">
        <h1 class="text-xl font-semibold">Profil Terapis</h1>
        <p class="text-sm opacity-80">Kelola informasi akun & rekening pembayaran</p>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- ================= INFORMASI AKUN ================= -->
    <div class="bg-white p-5 rounded-2xl shadow space-y-4">

        <h2 class="font-semibold text-gray-700">Informasi Akun</h2>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-medium">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-medium">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <span class="text-xs px-2 py-1 rounded-full
                    {{ $terapis->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    {{ $terapis->status ? 'Online' : 'Offline' }}
                </span>
            </div>

        </div>

    </div>

    <!-- ================= DATA TERAPIS ================= -->
    <form action="{{ route('terapis.profile.update') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="bg-white p-5 rounded-2xl shadow space-y-4">
        @csrf

        <h2 class="font-semibold text-gray-700">Data Terapis</h2>

        <div class="grid grid-cols-2 gap-4">

            <!-- NIK -->
            <div>
                <label class="text-xs text-gray-500">NIK</label>
                <input type="text" name="nik" value="{{ $terapis->nik }}"
                    class="w-full p-2 border rounded-lg">
            </div>

            <!-- GENDER -->
            <div>
                <label class="text-xs text-gray-500">Gender</label>
                <select name="gender" class="w-full p-2 border rounded-lg">
                    <option value="">Pilih</option>
                    <option value="L" {{ $terapis->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $terapis->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- WHATSAPP -->
            <div>
                <label class="text-xs text-gray-500">WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ $terapis->whatsapp }}"
                    class="w-full p-2 border rounded-lg">
            </div>

            <!-- TANGGAL LAHIR -->
            <div>
                <label class="text-xs text-gray-500">Tanggal Lahir</label>
                <input type="date" name="birth_date" value="{{ $terapis->birth_date }}"
                    class="w-full p-2 border rounded-lg">
            </div>

            <!-- KOTA / AREA KERJA -->
            <div class="col-span-2">
                <label class="text-xs text-gray-500">Area Kerja / Kota</label>

                <select name="city_id" 
                    class="w-full p-2 border rounded-lg">

                    <option value="">Pilih Kota</option>

                    @foreach($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ $user->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- ALAMAT -->
            <div class="col-span-2">
                <label class="text-xs text-gray-500">Alamat</label>
                <textarea name="address"
                    class="w-full p-2 border rounded-lg">{{ $terapis->address }}</textarea>
            </div>

        </div>


        <!-- ================= DOKUMEN ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t">

            <!-- FOTO -->
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">Foto Profil</p>

                @if($user->foto)
                    <img src="{{ asset('storage/'.$user->foto) }}"
                        class="w-20 h-20 object-cover rounded-full mx-auto mb-2">
                @else
                    <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-2"></div>
                @endif

                <input type="file" name="foto"
                    class="text-xs w-full">
            </div>

            <!-- KTP -->
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">KTP</p>

                @if($user->ktp)
                    <img src="{{ asset('storage/'.$user->ktp) }}"
                        class="h-20 object-cover mx-auto mb-2 rounded">
                @else
                    <div class="h-20 bg-gray-200 mx-auto mb-2"></div>
                @endif

                <input type="file" name="ktp"
                    class="text-xs w-full">
            </div>

            <!-- SKCK -->
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">SKCK</p>

                @if($user->skck)
                    <img src="{{ asset('storage/'.$user->skck) }}"
                        class="h-20 object-cover mx-auto mb-2 rounded">
                @else
                    <div class="h-20 bg-gray-200 mx-auto mb-2"></div>
                @endif

                <input type="file" name="skck"
                    class="text-xs w-full">
            </div>

        </div>


        <!-- BUTTON -->
        <button class="w-full bg-teal-600 text-white py-3 rounded-xl hover:bg-teal-700 transition">
            Simpan Data
        </button>

    </form>

    <!-- ================= REKENING ================= -->
    <div class="bg-white p-5 rounded-2xl shadow space-y-4">

        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-700">Rekening Pembayaran</h2>

            <button onclick="openModal()"
                class="bg-teal-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-teal-700">
                + Tambah
            </button>
        </div>

        @if($terapis->paymentAccounts->count())
            @foreach($terapis->paymentAccounts as $acc)

            <div class="border rounded-xl p-4 flex justify-between items-center">

                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $acc->bank_name }}
                    </p>

                    <p class="text-sm text-gray-600">
                        ****{{ substr($acc->account_number, -4) }}
                    </p>

                    <p class="text-xs text-gray-400">
                        a.n {{ $acc->account_holder }}
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    @if($acc->is_active)
                        <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-600">
                            Aktif
                        </span>
                    @else
                        <form action="{{ route('terapis.rekening.aktif',$acc->id) }}" method="POST">
                            @csrf
                            <button class="text-xs px-2 py-1 bg-teal-600 text-white rounded">
                                Aktifkan
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('terapis.rekening.delete',$acc->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs px-2 py-1 bg-red-500 text-white rounded">
                            Hapus
                        </button>
                    </form>

                </div>

            </div>

            @endforeach
        @else
            <p class="text-sm text-gray-500 text-center">
                Belum ada rekening
            </p>
        @endif

    </div>

</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow space-y-4">

        <h2 class="text-lg font-semibold text-gray-800">
            Tambah Rekening
        </h2>

        <form action="{{ route('terapis.rekening.store') }}" method="POST" class="space-y-3">
            @csrf

            <input type="text" name="bank_name" placeholder="Nama Bank"
                class="w-full p-2 border rounded-lg" required>

            <input type="text" name="account_holder" placeholder="Nama Pemilik"
                class="w-full p-2 border rounded-lg" required>

            <input type="text" name="account_number" placeholder="Nomor Rekening"
                class="w-full p-2 border rounded-lg" required>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg">
                    Batal
                </button>

                <button class="px-4 py-2 bg-teal-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal').classList.add('flex');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.getElementById('modal').classList.remove('flex');
}
</script>

@endsection