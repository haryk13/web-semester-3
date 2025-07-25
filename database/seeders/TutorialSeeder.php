<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tutorial;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tutorials = [
            [
                'name' => 'Bahasa C',
                'slug' => 'c',
                'description' => 'Tutorial lengkap bahasa pemrograman C dari dasar hingga mahir',
                'color' => 'blue',
                'language' => 'C',
                'tutorial_count' => 25,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'Belajar JavaScript dari dasar hingga framework modern',
                'color' => 'yellow',
                'language' => 'JavaScript',
                'tutorial_count' => 40,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Java',
                'slug' => 'java',
                'description' => 'Tutorial Java lengkap untuk pemula hingga advanced',
                'color' => 'red',
                'language' => 'Java',
                'tutorial_count' => 35,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'Belajar PHP untuk web development',
                'color' => 'purple',
                'language' => 'PHP',
                'tutorial_count' => 30,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Python',
                'slug' => 'python',
                'description' => 'Tutorial Python dari basic hingga data science',
                'color' => 'green',
                'language' => 'Python',
                'tutorial_count' => 45,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'C++',
                'slug' => 'cpp',
                'description' => 'Belajar C++ untuk sistem programming dan competitive programming',
                'color' => 'indigo',
                'language' => 'C++',
                'tutorial_count' => 28,
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($tutorials as $tutorial) {
            Tutorial::create($tutorial);
        }
    }
}
