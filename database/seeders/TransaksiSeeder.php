<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $nasabahs = Nasabah::all();

        foreach ($nasabahs as $nasabah) {
            Transaksi::create([
            'nasabah_id' => $nasabah->id,
            'jenis_transaksi' => 'setor',
            'nominal' => 500000,
            'saldo_sebelum' => $nasabah->saldo - 500000,
            'saldo_sesudah' => $nasabah->saldo,
            'keterangan' => 'Setoran awal',
            'tanggal_transaksi' => now()->subDays(rand(1, 5)),
        ]);
    }
}
}