<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        // Get published articles with pagination
        $articles = Article::with(['category', 'tags', 'user'])
            ->published()
            ->latest()
            ->paginate(12)
            ->through(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt,
                    'image' => $article->image,
                    'date' => $article->date,
                    'category' => $article->category->name,
                    'slug' => $article->slug,
                    'author' => $article->author,
                    'tags' => $article->tags->pluck('name')->toArray(),
                    'views_count' => $article->views_count,
                    'reading_time' => $article->reading_time . ' menit'
                ];
            });

        return Inertia::render('Articles/Index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article)
    {
        // Only show published articles
        if (!$article->is_published) {
            abort(404);
        }

        // Increment views count
        $article->incrementViews();

        // Load relationships
        $article->load(['category', 'tags', 'user']);

        return Inertia::render('Articles/Show', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'image' => $article->image,
                'date' => $article->date,
                'category' => $article->category->name,
                'slug' => $article->slug,
                'author' => $article->author,
                'tags' => $article->tags->pluck('name')->toArray(),
                'reading_time' => $article->reading_time . ' menit',
                'views_count' => $article->views_count
            ]
        ]);
    }
}
