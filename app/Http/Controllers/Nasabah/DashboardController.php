<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        return view('nasabah.dashboard', compact('nasabahs'));
    }

    public function deposit(Request $request): RedirectResponse
    {
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        $totalsaldo = $nasabahs->saldo + $request->saldo;
        $nasabahs->update([
            'saldo' => $totalsaldo,
        ]);

        return redirect()->route('nasabah.dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function withdraw(Request $request): RedirectResponse
    {
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        $totalsaldo = $nasabahs->saldo - $request->saldo;
        $nasabahs->update([
            'saldo' => $totalsaldo,
        ]);

        return redirect()->route('nasabah.dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function transfer(Request $request): RedirectResponse
    {
        $nasabahtujuan = User::where('name', $request->namanasabah)->first();
        $akunnasabah = Nasabah::where('user_id', $nasabahtujuan->id)->first();
        $hasiltransfer = $akunnasabah->saldo + $request->saldo;
        $akunnasabah->update([
            'saldo' => $hasiltransfer,
        ]);

        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        $totalsaldo = $nasabahs->saldo - $request->saldo;
        $nasabahs->update([
            'saldo' => $totalsaldo,
        ]);

        return redirect()->route('nasabah.dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
