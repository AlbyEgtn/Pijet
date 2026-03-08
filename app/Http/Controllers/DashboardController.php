<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function superadmin()
    {
        return view('pages.superadmin.dashboard');
    }

    public function admin()
    {
        return view('pages.admin.dashboard');
    }

    public function finance()
    {
        return view('pages.finance.dashboard');
    }

    public function terapis()
    {
        return view('pages.terapis.dashboard');
    }

    public function customer()
    {
        return view('pages.customer.dashboard');
    }

}