<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tutorial;
use App\Models\Tag;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'categories' => Category::count(),
            'tutorials' => Tutorial::count(),
            'tags' => Tag::count(),
            'users' => User::count(),
            'recent_articles' => Article::with(['category', 'user'])
                ->latest()
                ->limit(5)
                ->get()
                ->map(function ($article) {
                    return [
                        'id' => $article->id,
                        'title' => $article->title,
                        'slug' => $article->slug,
                        'category' => $article->category->name,
                        'author' => $article->user->name,
                        'is_published' => $article->is_published,
                        'published_at' => $article->published_at?->format('d M Y'),
                        'views_count' => $article->views_count,
                    ];
                }),
        ];

        return Inertia::render('Admin/Dashboard', compact('stats'));
    }
}
