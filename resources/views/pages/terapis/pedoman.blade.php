@extends('layouts.terapis')

@section('title', 'Pedoman Terapis')

@section('content')

<div class="max-w-5xl mx-auto mt-10 bg-white shadow rounded-xl p-8">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-gray-700 mb-8 flex items-center gap-2">

        <a 
            href="{{ route('terapis.profile') }}"
            class="text-gray-600 hover:text-gray-800"
        >
            ←
        </a>

        Pedoman Terapis

    </h2>


    <!-- PEMBUATAN AKUN -->
    <div class="mb-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-2">
            1. Pembuatan Akun
        </h3>

        <p class="text-gray-600 leading-relaxed">
            Terapis diwajibkan membuat akun terlebih dahulu dan mengikuti seluruh persyaratan 
            yang telah ditentukan oleh sistem.
        </p>

        <p class="text-gray-600 mt-2 leading-relaxed">
            Setelah proses registrasi selesai, akun akan melalui proses validasi 
            dan review oleh admin sebelum dapat digunakan secara penuh.
        </p>

    </div>


    <!-- METODE PENCAIRAN -->
    <div class="mb-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            2. Metode Pencairan
        </h3>

        <ul class="list-disc ml-6 text-gray-600 space-y-2">

            <li>
                <strong>Cash:</strong> Pencairan dilakukan secara langsung kepada admin yang bertugas.
            </li>

            <li>
                <strong>Transfer:</strong> Gunakan nomor rekening resmi yang tersedia 
                pada aplikasi atau platform.
            </li>

        </ul>

    </div>


    <!-- METODE PEMBAYARAN -->
    <div class="mb-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            3. Metode Pembayaran
        </h3>

        <p class="text-gray-600 mb-3">
            Terapis dapat menolak pesanan kapan saja apabila terdapat keperluan mendadak,
            selama pesanan belum melewati batas waktu yang telah ditentukan.
            Ketentuan ini berlaku untuk semua metode pembayaran.
        </p>


        <!-- CASH -->
        <div class="ml-4 mb-4">

            <p class="font-medium text-gray-700 mb-1">
                Cash
            </p>

            <ul class="list-disc ml-6 text-gray-600 space-y-2">

                <li>
                    Jika status card riwayat sudah <strong>"Dijadwalkan"</strong> 
                    dan customer mengajukan pembatalan, maka akan diberikan peringatan oleh admin.
                </li>

                <li>
                    Maksimal 3 kali peringatan. Apabila melebihi batas tersebut,
                    akun berpotensi dipending atau dibanned.
                </li>

            </ul>

        </div>


        <!-- TRANSFER -->
        <div class="ml-4">

            <p class="font-medium text-gray-700 mb-1">
                Transfer
            </p>

            <ul class="list-disc ml-6 text-gray-600 space-y-2">

                <li>
                    Jika customer mengajukan pembatalan, maka biaya akan dipotong 
                    sebesar <strong>80% per layanan</strong> oleh admin.
                </li>

                <li>
                    Customer wajib mencantumkan nomor rekening ketika mengajukan refund.
                </li>

            </ul>

        </div>

    </div>


    <!-- ULASAN PELANGGAN -->
    <div class="mb-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            4. Ulasan Pelanggan
        </h3>

        <p class="text-gray-600 leading-relaxed">
            Setelah layanan selesai dan card riwayat berstatus 
            <strong>"Selesai"</strong>, terapis dimohon untuk memberikan 
            bukti pembayaran (jika menggunakan metode cash) sesuai 
            dengan format yang telah disediakan oleh sistem.
        </p>

    </div>


    <!-- WAKTU TUNGGU -->
    <div class="mb-8">

        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            5. Waktu Tunggu
        </h3>

        <p class="text-gray-600 leading-relaxed">
            Card riwayat dengan status <strong>"Menunggu"</strong> memiliki 
            estimasi waktu maksimal <strong>1 x 24 jam</strong> sebelum 
            diproses oleh sistem atau terapis.
        </p>

    </div>


    <!-- KETENTUAN -->
    <div>

        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            6. Ketentuan
        </h3>

        <p class="text-gray-600 leading-relaxed">
            Terapis dihimbau untuk selalu memperhatikan pembaruan syarat 
            dan ketentuan yang tersedia pada sistem agar tidak terjadi 
            kesalahpahaman dalam penggunaan platform.
        </p>

    </div>


</div>

@endsection