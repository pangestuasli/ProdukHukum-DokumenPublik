<?php

namespace Database\Seeders;

use App\Models\Guest;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Guest::factory(10)->create();

        Guest::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
