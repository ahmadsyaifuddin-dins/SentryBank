<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    {
        return view('teller.dashboard');
    }
}
