<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->is_admin) {
            return view('admin.dashboard');
        } else {
            return view('dashboard');
        }
    }
}
