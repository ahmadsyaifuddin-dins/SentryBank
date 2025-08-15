<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        $transaksis = Transaksi::where('nasabah_id', $nasabahs->id)->get();
        $transfers = Transfer::where('dari_nasabah_id', $nasabahs->id)->get();

        $arrayriwayat = array();
        foreach($transaksis as $transaksi){
            $arrayriwayat[] = $transaksi;
        }
        foreach($transfers as $transfer){
            $arrayriwayat[] = $transfer;
        }



        return view('nasabah.transaksi', compact('arrayriwayat'));
    }
}
