<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Basic Programming',
                'slug' => 'pemrograman',
                'description' => 'Tutorial dasar-dasar pemrograman menggunakan berbagai bahasa',
                'color' => 'blue',
                'icon' => 'code',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Web Programming',
                'slug' => 'web',
                'description' => 'Tutorial pengembangan web dari frontend hingga backend',
                'color' => 'green',
                'icon' => 'globe',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Mobile Programming',
                'slug' => 'mobile',
                'description' => 'Tutorial pengembangan aplikasi mobile Android dan iOS',
                'color' => 'purple',
                'icon' => 'mobile',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Game Programming',
                'slug' => 'game',
                'description' => 'Tutorial membuat game dengan berbagai engine',
                'color' => 'red',
                'icon' => 'gamepad',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Tutorial analisis data dan machine learning',
                'color' => 'yellow',
                'icon' => 'chart',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Tutorial deployment, CI/CD, dan infrastructure',
                'color' => 'indigo',
                'icon' => 'server',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
