<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get latest published articles with category and tags
        $latestArticles = Article::with(['category', 'tags'])
            ->published()
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt,
                    'image' => $article->image,
                    'date' => $article->date,
                    'category' => $article->category->name,
                    'slug' => $article->slug,
                    'author' => $article->author,
                    'reading_time' => $article->reading_time . ' menit'
                ];
            });

        return Inertia::render('Home', [
            'latestArticles' => $latestArticles,
        ]);
    }
}
