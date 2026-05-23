<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kofi Mensah',
            'email' => 'kofi@support.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Ama Owusu',
            'email' => 'ama@support.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Yaw Darko',
            'email' => 'yaw@support.com',
            'password' => Hash::make('password')
        ]);
    }
}
