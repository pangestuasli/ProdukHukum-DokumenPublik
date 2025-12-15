<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=> "arya",
            "email"=> "pangestu24si@mahasiswa.pcr.ac.id",
            "password"=>Hash::make("arya123"),
            "role" => "admin",
        ]);
    }
}
