<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Tuken',
            'email' => 'tuken@gmail.com',
            'password' => Hash::make('tuken123'),
            'role' => 'admin'
        ]);
    }
}