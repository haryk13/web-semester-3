<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create an admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@weblearning.com'],
            [
                'name' => 'Admin Web',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Get categories
        $webCategory = Category::where('slug', 'web')->first();
        $basicCategory = Category::where('slug', 'pemrograman')->first();
        $mobileCategory = Category::where('slug', 'mobile')->first();

        // Get tags
        $laravelTag = Tag::where('slug', 'laravel')->first();
        $phpTag = Tag::where('slug', 'php')->first();
        $jsTag = Tag::where('slug', 'javascript')->first();
        $reactTag = Tag::where('slug', 'react')->first();
        $cppTag = Tag::where('slug', 'cpp')->first();
        $pythonTag = Tag::where('slug', 'python')->first();

        // Create articles
        $articles = [
            [
                'title' => 'Tutorial Laravel 11 untuk Pemula: Panduan Lengkap CRUD',
                'slug' => 'tutorial-laravel-11-pemula-crud',
                'excerpt' => 'Tutorial Laravel 11 lengkap untuk pemula disertai latihan membuat CRUD dari awal. Panduan step-by-step yang mudah diikuti.',
                'content' => '<h2>Pengenalan Laravel 11</h2>
                              <p>Laravel adalah framework PHP yang sangat populer untuk pengembangan web. Pada tutorial ini, kita akan belajar Laravel 11 dari dasar hingga bisa membuat aplikasi CRUD (Create, Read, Update, Delete).</p>
                              <h2>Persiapan</h2>
                              <p>Sebelum memulai, pastikan kamu sudah menginstall:</p>
                              <ul>
                                  <li>PHP 8.2 atau lebih tinggi</li>
                                  <li>Composer</li>
                                  <li>Node.js dan NPM</li>
                                  <li>Database (MySQL/PostgreSQL)</li>
                              </ul>
                              <h2>Instalasi Laravel 11</h2>
                              <p>Untuk menginstall Laravel 11, jalankan perintah berikut:</p>
                              <pre><code>composer create-project laravel/laravel nama-project</code></pre>',
                'image' => '/images/laravel-tutorial.jpg',
                'category_id' => $webCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 15,
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'views_count' => 150,
                'tags' => [$laravelTag, $phpTag]
            ],
            [
                'title' => 'JavaScript Modern: ES6+ Features yang Wajib Dikuasai',
                'slug' => 'javascript-modern-es6-features',
                'excerpt' => 'Pelajari fitur-fitur modern JavaScript ES6+ yang wajib dikuasai developer modern. Dari arrow functions hingga async/await.',
                'content' => '<h2>Apa itu ES6+?</h2>
                              <p>ES6 (ECMAScript 2015) dan versi selanjutnya membawa banyak fitur baru yang membuat JavaScript lebih powerful dan mudah digunakan.</p>
                              <h2>Arrow Functions</h2>
                              <p>Sintaks yang lebih ringkas untuk menulis function:</p>
                              <pre><code>const greet = (name) => `Hello, ${name}!`;</code></pre>
                              <h2>Template Literals</h2>
                              <p>Cara yang lebih mudah untuk string interpolation:</p>
                              <pre><code>const message = `Welcome ${userName} to our website!`;</code></pre>',
                'image' => '/images/javascript-es6.jpg',
                'category_id' => $webCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 12,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 230,
                'tags' => [$jsTag]
            ],
            [
                'title' => 'React untuk Pemula: Membangun Aplikasi Web Modern',
                'slug' => 'react-pemula-aplikasi-web-modern',
                'excerpt' => 'Panduan lengkap React untuk pemula. Belajar component, state, props, dan hooks untuk membangun aplikasi web yang interaktif.',
                'content' => '<h2>Apa itu React?</h2>
                              <p>React adalah library JavaScript untuk membangun user interfaces, terutama untuk aplikasi web single-page.</p>
                              <h2>Komponen React</h2>
                              <p>Komponen adalah building blocks dari aplikasi React:</p>
                              <pre><code>function Welcome(props) {
  return <h1>Hello, {props.name}</h1>;
}</code></pre>
                              <h2>State dan Props</h2>
                              <p>State untuk data yang bisa berubah, props untuk passing data antar komponen.</p>',
                'image' => '/images/react-tutorial.jpg',
                'category_id' => $webCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 18,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views_count' => 189,
                'tags' => [$jsTag, $reactTag]
            ],
            [
                'title' => 'Belajar C++ #1: Pengenalan dan Setup Environment',
                'slug' => 'belajar-cpp-pengenalan-setup',
                'excerpt' => 'Tutorial C++ untuk pemula. Mulai dari pengenalan bahasa C++, cara install compiler, hingga menulis program pertama.',
                'content' => '<h2>Apa itu C++?</h2>
                              <p>C++ adalah bahasa pemrograman yang dikembangkan dari bahasa C dengan tambahan fitur object-oriented programming.</p>
                              <h2>Setup Environment</h2>
                              <p>Untuk mulai programming C++, kamu perlu:</p>
                              <ul>
                                  <li>Text editor atau IDE (Code::Blocks, Visual Studio, VS Code)</li>
                                  <li>Compiler C++ (GCC, Clang, atau MSVC)</li>
                              </ul>
                              <h2>Program Pertama</h2>
                              <pre><code>#include <iostream>
using namespace std;

int main() {
    cout << "Hello, World!" << endl;
    return 0;
}</code></pre>',
                'image' => '/images/cpp-basics.jpg',
                'category_id' => $basicCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 10,
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'views_count' => 312,
                'tags' => [$cppTag]
            ],
            [
                'title' => 'Python untuk Data Science: Pandas dan NumPy',
                'slug' => 'python-data-science-pandas-numpy',
                'excerpt' => 'Belajar menggunakan Python untuk data science dengan library Pandas dan NumPy. Tutorial lengkap dengan contoh praktis.',
                'content' => '<h2>Mengapa Python untuk Data Science?</h2>
                              <p>Python menjadi pilihan utama untuk data science karena ekosistem library yang kuat dan sintaks yang mudah dipahami.</p>
                              <h2>NumPy untuk Numerical Computing</h2>
                              <p>NumPy menyediakan array multidimensional yang efisien:</p>
                              <pre><code>import numpy as np
arr = np.array([1, 2, 3, 4, 5])
print(arr.mean())</code></pre>
                              <h2>Pandas untuk Data Manipulation</h2>
                              <p>Pandas menyediakan struktur data DataFrame yang powerful:</p>
                              <pre><code>import pandas as pd
df = pd.read_csv("data.csv")
print(df.head())</code></pre>',
                'image' => '/images/python-data-science.jpg',
                'category_id' => $basicCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 20,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 275,
                'tags' => [$pythonTag]
            ],
            [
                'title' => 'Flutter vs React Native: Mana yang Lebih Baik?',
                'slug' => 'flutter-vs-react-native-comparison',
                'excerpt' => 'Perbandingan lengkap antara Flutter dan React Native untuk pengembangan aplikasi mobile. Pilih yang sesuai dengan kebutuhanmu.',
                'content' => '<h2>Pengenalan</h2>
                              <p>Flutter dan React Native adalah dua framework populer untuk pengembangan aplikasi mobile cross-platform.</p>
                              <h2>Flutter</h2>
                              <p>Dikembangkan oleh Google, menggunakan bahasa Dart. Kompilasi ke native code untuk performa optimal.</p>
                              <h2>React Native</h2>
                              <p>Dikembangkan oleh Facebook, menggunakan JavaScript dan React. Bridge ke native components.</p>
                              <h2>Perbandingan</h2>
                              <ul>
                                  <li><strong>Performance:</strong> Flutter sedikit lebih cepat</li>
                                  <li><strong>Learning Curve:</strong> React Native lebih mudah jika sudah tahu React</li>
                                  <li><strong>Community:</strong> React Native lebih besar</li>
                              </ul>',
                'image' => '/images/flutter-vs-react-native.jpg',
                'category_id' => $mobileCategory->id,
                'user_id' => $user->id,
                'author_name' => 'Admin Web',
                'reading_time' => 14,
                'is_published' => true,
                'published_at' => now()->subDays(6),
                'views_count' => 198,
                'tags' => []
            ]
        ];

        foreach ($articles as $articleData) {
            $tags = $articleData['tags'] ?? [];
            unset($articleData['tags']);
            
            $article = Article::create($articleData);
            
            if (!empty($tags)) {
                $article->tags()->attach($tags);
            }
        }
    }
}
