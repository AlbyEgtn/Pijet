<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Service;

class ServiceCustController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $services = Service::query()
            ->select('id','name','price','duration','image')
            ->where('is_active', true)
            ->where('is_additional', false)
            ->when($search, function($q) use ($search){
                $q->where('name','like','%'.$search.'%');
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $additionalServices = Service::query()
            ->select('id','name','price','description','image')
            ->where('is_active', true)
            ->where('is_additional', true)
            ->latest()
            ->limit(6)
            ->get();


        return view('pages.customer.services.index', compact(
            'services',
            'additionalServices'
        ));
    }

}

