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
        $services = Service::select('id','name','price','image')
            ->where('is_active', true)
            ->where('is_additional', false)
            ->limit(8)
            ->get();

        $additionalServices = Service::select('id','name','price','image','description')
            ->where('is_active', true)
            ->where('is_additional', true)
            ->limit(4)
            ->get();
            
        return view('pages.customer.dashboard',[
            'services' => $services,
            'additionalServices' => $additionalServices
        ]);

    }
}
