<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceCustController extends Controller
{

    public function index(Request $request)
    {

        $query = Service::where('is_active', true);

        if($request->search){

            $query->where('name','like','%'.$request->search.'%');

        }

        $services = $query
            ->where('is_additional', false)
            ->get();

        $additionalServices = Service::where('is_additional', true)
            ->where('is_active', true)
            ->get();

        return view('pages.customer.services.index',[
            'services' => $services,
            'additionalServices' => $additionalServices
        ]);

    }

}