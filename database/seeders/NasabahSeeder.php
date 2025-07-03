<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Database\Seeder;

class NasabahSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'nasabah')->get();
        foreach ($users as $user) {
            Nasabah::create([
                'user_id' => $user->id,
                'no_rekening' => '100' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'nik' => '3275' . rand(10000000, 99999999),
                'alamat' => 'Jl. Dummy No. ' . rand(1, 100),
                'tanggal_lahir' => now()->subYears(rand(20, 40))->format('Y-m-d'),
                'jenis_kelamin' => ['Laki-laki', 'Perempuan'][rand(0, 1)],
                'saldo' => rand(1000000, 5000000),
                'status_akun' => 'aktif',
                'kewarganegaraan' => ['WNI', 'WNA'][rand(0, 1)],
                'no_hp' => '08' . rand(100000000, 999999999),
            ]);
        }
    }
}
