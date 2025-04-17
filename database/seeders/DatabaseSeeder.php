<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::create([
            'name' => 'Admin Checker',
            'email' => 'adminchecker@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
