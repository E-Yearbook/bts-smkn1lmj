<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
        ]);

        // Admin
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // User (Login menggunakan NIS)
        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@gmail.com',
            'nis' => 19710071063,
            'password' => Hash::make('19710071063'), // NIS jadi password
            'role' => 'user',
            'year_generation' => 54
        ]);
    }
}