<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\Transfer;
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

        $saldosebelum = $nasabahs->saldo;
        $saldosesudah = $totalsaldo;

        Transaksi::create([
            'nasabah_id' => $nasabahs->id,
            'jenis_transaksi' => 'setor',
            'nominal' => $request->saldo,
            'saldo_sebelum' => $saldosebelum,
            'saldo_sesudah' => $saldosesudah,
            'keterangan' => 'Menabung ke Rekening',
            'tanggal_transaksi' => now(),
        ]);

        $nasabahs->update([
            'saldo' => $totalsaldo,
        ]);

        return redirect()->route('nasabah.dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function withdraw(Request $request): RedirectResponse
    {
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();
        $totalsaldo = $nasabahs->saldo - $request->saldo;

        $saldosebelum = $nasabahs->saldo;
        $saldosesudah = $totalsaldo;

        Transaksi::create([
            'nasabah_id' => $nasabahs->id,
            'jenis_transaksi' => 'tarik',
            'nominal' => $request->saldo,
            'saldo_sebelum' => $saldosebelum,
            'saldo_sesudah' => $saldosesudah,
            'keterangan' => 'Tarik uang dari Rekening',
            'tanggal_transaksi' => now(),
        ]);

        $nasabahs->update([
            'saldo' => $totalsaldo,
        ]);

        return redirect()->route('nasabah.dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function transfer(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'norekening' => 'required',
            'saldo' => 'required|numeric|min:1000|max:20000000',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Ambil data pengirim
        $nasabahPengirim = Nasabah::where('user_id', Auth::id())->first();

        // Ambil data penerima
        $nasabahPenerima = Nasabah::where('no_rekening', $request->norekening)->first();
        if (!$nasabahPenerima) {
            return back()->withErrors(['norekening' => 'Nomor rekening tujuan tidak ditemukan']);
        }

        // Cegah transfer ke rekening sendiri
        if ($nasabahPengirim->id === $nasabahPenerima->id) {
            return back()->withErrors(['norekening' => 'Tidak bisa transfer ke rekening sendiri']);
        }

        // Cek saldo cukup
        if ($nasabahPengirim->saldo < $request->saldo) {
            return back()->withErrors(['saldo' => 'Saldo tidak mencukupi']);
        }

        // Proses transfer
        $nasabahPenerima->update([
            'saldo' => $nasabahPenerima->saldo + $request->saldo
        ]);

        $nasabahPengirim->update([
            'saldo' => $nasabahPengirim->saldo - $request->saldo
        ]);

        // Catat riwayat ke tabel transfers
        Transfer::create([
            'dari_nasabah_id' => $nasabahPengirim->id,
            'ke_nasabah_id' => $nasabahPenerima->id,
            'nominal' => $request->saldo,
            'keterangan' => $request->keterangan,
            'waktu_transfer' => now(),
        ]);

        return redirect()->route('nasabah.dashboard')->with('success', 'Transfer berhasil');
    }
}
