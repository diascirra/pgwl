<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'diascirra',
            'email' => 'user@gmail.com',
            'password' => bcrypt('admin123'),
        ]
    );
        User::factory()->create([
            'name' => 'diascirra2',
            'email' => 'dias@gmail.com',
            'password' => bcrypt('admin123'),
        ]
    );
    }
}
