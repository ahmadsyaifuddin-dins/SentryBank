<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin SentryBank',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Teller
        User::create([
            'name' => 'Teller 1',
            'email' => 'teller@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teller',
            'is_active' => true,
        ]);

        // Nasabah
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Nasabah $i",
                'email' => "nasabah$i@gmail.com",
                'password' => Hash::make('password'),
                'role' => 'nasabah',
                'is_active' => true,
            ]);
        }
    }
}
