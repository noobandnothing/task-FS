<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'noob1',
            'email' => 'noob1@gmail.com',
            'address' => '123 Fawry Street, Cairo',
            'phone' => '012345678910',
            'balance' => 1000,
            'email_verified_at' => now(),
            'password' => Hash::make('password1234'),
        ]);

        User::create([
            'name' => 'noob2',
            'email' => 'noob2@gmail.com',
            'address' => '125 Fawry Street, Cairo',
            'phone' => '012345678917',
            'balance' => 250,
            'email_verified_at' => now(),
            'password' => Hash::make('no_password'),
        ]);
    }
}
