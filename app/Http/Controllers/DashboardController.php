<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirect()
    {
        return match (auth()->user()->role) {
            'seller' => redirect()->route('seller.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('customer.dashboard'),
        };
    }

    public function customer()
    {
        return view('dashboard.customer');
    }

    public function seller()
    {
        return view('dashboard.seller');
    }

    public function employee()
    {
        return view('dashboard.employee');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }
}