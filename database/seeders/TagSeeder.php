<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => 'red'],
            ['name' => 'PHP', 'slug' => 'php', 'color' => 'purple'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => 'yellow'],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'color' => 'green'],
            ['name' => 'React', 'slug' => 'react', 'color' => 'blue'],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'color' => 'green'],
            ['name' => 'Python', 'slug' => 'python', 'color' => 'blue'],
            ['name' => 'Java', 'slug' => 'java', 'color' => 'orange'],
            ['name' => 'C++', 'slug' => 'cpp', 'color' => 'blue'],
            ['name' => 'C', 'slug' => 'c', 'color' => 'gray'],
            ['name' => 'Golang', 'slug' => 'golang', 'color' => 'blue'],
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => 'blue'],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'color' => 'blue'],
            ['name' => 'Redis', 'slug' => 'redis', 'color' => 'red'],
            ['name' => 'Docker', 'slug' => 'docker', 'color' => 'blue'],
            ['name' => 'CRUD', 'slug' => 'crud', 'color' => 'gray'],
            ['name' => 'API', 'slug' => 'api', 'color' => 'gray'],
            ['name' => 'Frontend', 'slug' => 'frontend', 'color' => 'pink'],
            ['name' => 'Backend', 'slug' => 'backend', 'color' => 'gray'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'color' => 'green'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'color' => 'purple'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'color' => 'orange'],
            ['name' => 'Machine Learning', 'slug' => 'machine-learning', 'color' => 'purple'],
            ['name' => 'Programming', 'slug' => 'programming', 'color' => 'blue'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => 'gray'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
