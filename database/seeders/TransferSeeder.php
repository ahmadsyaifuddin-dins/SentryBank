<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use App\Models\Transfer;
use Illuminate\Database\Seeder;

class TransferSeeder extends Seeder
{
    public function run()
    {
        $dari = Nasabah::first();
        $ke = Nasabah::skip(1)->first();

        if ($dari && $ke) {
            Transfer::create([
                'dari_nasabah_id' => $dari->id,
                'ke_nasabah_id' => $ke->id,
                'nominal' => 250000,
                'keterangan' => 'Transfer testing',
                'waktu_transfer' => now(),
            ]);
        }
    }
}
