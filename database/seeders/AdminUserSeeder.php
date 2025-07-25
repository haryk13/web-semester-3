<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing admin user or create new one
        $adminUser = User::where('email', 'admin@weblearning.com')->first();
        
        if ($adminUser) {
            $adminUser->update(['role' => 'admin']);
            $this->command->info('Updated existing admin user role to admin.');
        } else {
            User::create([
                'name' => 'Admin Web',
                'email' => 'admin@weblearning.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]);
            $this->command->info('Created new admin user.');
        }

        // Create an editor user for testing
        User::firstOrCreate(
            ['email' => 'editor@weblearning.com'],
            [
                'name' => 'Editor Web',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'editor',
            ]
        );

        // Create a regular user for testing
        User::firstOrCreate(
            ['email' => 'user@weblearning.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'user',
            ]
        );
    }
}
