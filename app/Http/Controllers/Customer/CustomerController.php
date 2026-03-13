<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Service;

class CustomerController extends Controller
{
    public function customer()
    {

        // layanan utama
        $services = Service::where('is_active', true)
            ->where('is_additional', false)
            ->limit(8)
            ->get();

        // layanan tambahan
        $additionalServices = Service::where('is_active', true)
            ->where('is_additional', true)
            ->limit(4)
            ->get();

        return view('pages.customer.dashboard',[
            'services' => $services,
            'additionalServices' => $additionalServices
        ]);

    }
}
