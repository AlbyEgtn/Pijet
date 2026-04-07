@extends('layouts.finance')

@section('title','Pengaturan')
@section('header','Pengaturan')

@section('content')

<div class="p-6 max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-5 rounded-2xl shadow">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-xl font-semibold">
                    Pengaturan Keuangan
                </h1>
                <p class="text-sm opacity-90">
                    Rekening perusahaan & saldo
                </p>
            </div>

            <div class="text-right">
                <p class="text-xs opacity-80">Total Saldo</p>
                <p class="text-lg font-semibold">
                    Rp {{ number_format($totalCompany,0,',','.') }}
                </p>
            </div>

        </div>

    </div>

    <!-- LIST REKENING -->
    <div class="bg-white rounded-2xl shadow p-5 space-y-4">

        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-700">
                Rekening Perusahaan
            </h2>

            <span class="text-xs text-gray-400">
                {{ count($companyAccounts) }} rekening
            </span>
        </div>

        @forelse($companyAccounts as $account)

            @php
                $balance = $account->balance ?? 0;
            @endphp

            <div class="border rounded-xl p-4 hover:shadow transition">

                <div class="flex justify-between items-center">

                    <!-- INFO -->
                    <div>
                        <p class="font-medium text-gray-800">
                            {{ $account->bank_name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $account->account_holder }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1">
                            {{ $account->account_number }}
                        </p>
                    </div>

                    <!-- SALDO -->
                    <div class="text-right">

                        <p class="text-lg font-semibold 
                            {{ $balance > 0 ? 'text-teal-600' : 'text-gray-400' }}">
                            
                            Rp {{ number_format($balance,0,',','.') }}
                        </p>

                        <span class="text-xs px-3 py-1 rounded-full 
                            {{ $account->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            
                            {{ $account->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center py-10">

                <p class="text-gray-400 text-sm">
                    Tidak ada rekening aktif
                </p>

            </div>

        @endforelse

    </div>

    <!-- INFO -->
    <div class="bg-gray-50 rounded-2xl p-4 text-sm text-gray-600 space-y-1">

        <p>
            • Saldo dihitung dari transaksi <b>transfer yang sudah diverifikasi</b>
        </p>

        <p>
            • Transaksi cash tidak masuk ke rekening
        </p>

        <p>
            • Saldo sudah merupakan <b>bagian perusahaan (company income)</b>
        </p>

    </div>

</div>

@endsection