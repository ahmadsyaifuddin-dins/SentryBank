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
        // 1️⃣ Ambil data nasabah yang sedang login berdasarkan user_id
        $nasabahs = Nasabah::where('user_id', Auth::id())->first();

        // 2️⃣ Ambil data transfer yang melibatkan nasabah login (baik sebagai pengirim atau penerima)
        //    with() digunakan untuk eager loading relasi keNasabah dan dariNasabah beserta user-nya
        $transfers = Transfer::with(['dariNasabah.user', 'keNasabah.user'])
            ->where('dari_nasabah_id', $nasabahs->id)   // Transfer yang dikirim oleh nasabah ini
            ->orWhere('ke_nasabah_id', $nasabahs->id)   // Transfer yang diterima nasabah ini
            ->get();

        // 3️⃣ Ambil data transaksi biasa (setor dan tarik tunai) milik nasabah ini
        //    with() digunakan untuk eager loading relasi nasabah beserta user-nya
        $transaksis = Transaksi::with(['nasabah.user'])
            ->where('nasabah_id', $nasabahs->id)
            ->get();

        // 4️⃣ Siapkan array kosong untuk menampung gabungan riwayat transaksi
        $arrayriwayat = [];

        // 5️⃣ Loop data transfer dan tambahkan atribut tambahan untuk ditampilkan di view
        foreach ($transfers as $transfer) {
            $transfer->tipe = 'transfer'; // Penanda jenis data ini adalah transfer
            $transfer->tanggal = $transfer->waktu_transfer
                ? date('d-m-Y H:i', strtotime($transfer->waktu_transfer)) // Format tanggal & jam
                : '-';
            $transfer->dari = $transfer->dariNasabah->user->name ?? '-'; // Nama pengirim
            $transfer->ke   = $transfer->keNasabah->user->name ?? '-';   // Nama penerima
            $transfer->nominal_formatted = $transfer->FormattedSaldo;   // Nominal format rupiah
            $arrayriwayat[] = $transfer; // Masukkan ke array riwayat
        }

        // 6️⃣ Loop data transaksi biasa (setor/tarik) dan tambahkan atribut untuk view
        foreach ($transaksis as $transaksi) {
            $transaksi->tipe = 'transaksi'; // Penanda jenis data ini adalah transaksi biasa
            $transaksi->tanggal = $transaksi->tanggal_transaksi
                ? date('d-m-Y H:i', strtotime($transaksi->tanggal_transaksi)) // Format tanggal & jam
                : '-';
            $transaksi->dari = $transaksi->nasabah->user->name ?? '-'; // Nama nasabah
            $transaksi->ke   = null; // Tidak ada penerima karena ini setor/tarik
            $transaksi->nominal_formatted = $transaksi->FormattedSaldo; // Nominal format rupiah
            $arrayriwayat[] = $transaksi; // Masukkan ke array riwayat
        }

        // 7️⃣ Urutkan array gabungan berdasarkan tanggal terbaru
        usort($arrayriwayat, function ($a, $b) {
            return strtotime($b->tanggal) - strtotime($a->tanggal);
        });

        // 8️⃣ Kirim data riwayat ke view 'nasabah.transaksi'
        return view('nasabah.transaksi', compact('arrayriwayat'));
    }
}
