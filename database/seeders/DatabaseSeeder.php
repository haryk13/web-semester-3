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
        // Run the custom seeders in order
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            TutorialSeeder::class,
            AdminUserSeeder::class,
            ArticleSeeder::class,
        ]);

        // Default test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
