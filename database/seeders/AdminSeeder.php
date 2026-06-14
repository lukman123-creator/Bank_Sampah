<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@banksampah.com'], // Email untuk login
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'), // Password untuk login
                'role' => 'admin', // Role diset sebagai admin
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@banksampah.com'], // Email untuk login tester user
            [
                'name' => 'Tester User',
                'password' => Hash::make('user12345'), // Password untuk login
                'role' => 'user', // Role diset sebagai user biasa
                'balance' => 50000, // Saldo awal simulasi
            ]
        );
    }
}
