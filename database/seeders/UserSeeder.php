<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder pengguna.
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'username' => 'admin',
                'email' => 'admin@erentbook.test',
                'password' => Hash::make('admin123'),
                'phone' => '081234567890',
                'address' => 'Jl. Admin Utama No.1',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // User - Inactive
            [
                'username' => 'user_inactive',
                'email' => 'inactive@erentbook.test',
                'password' => Hash::make('password'),
                'phone' => '081111111111',
                'address' => 'Jl. Inaktif No.2',
                'role' => 'user',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // User - Active
            [
                'username' => 'user_active',
                'email' => 'active@erentbook.test',
                'password' => Hash::make('password'),
                'phone' => '082222222222',
                'address' => 'Jl. Aktif No.3',
                'role' => 'user',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // User - Banned
            [
                'username' => 'user_banned',
                'email' => 'banned@erentbook.test',
                'password' => Hash::make('password'),
                'phone' => '083333333333',
                'address' => 'Jl. Banned No.4',
                'role' => 'user',
                'status' => 'banned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
