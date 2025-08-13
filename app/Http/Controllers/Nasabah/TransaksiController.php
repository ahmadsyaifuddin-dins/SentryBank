<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $transaksis = Transaksi::where('nasabah_id', Auth::id())->get();
        return view('nasabah.transaksi', compact('transaksis'));
    }
}
