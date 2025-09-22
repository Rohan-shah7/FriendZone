<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users with different roles
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'role' => 'member',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);
    }
}
