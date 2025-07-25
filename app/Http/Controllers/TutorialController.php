<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Tutorial;

class TutorialController extends Controller
{
    public function index()
    {
        $categories = Tutorial::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($tutorial) {
                return [
                    'id' => $tutorial->id,
                    'name' => $tutorial->name,
                    'slug' => $tutorial->slug,
                    'description' => $tutorial->description,
                    'tutorial_count' => $tutorial->tutorial_count,
                    'color' => $tutorial->color,
                    'language' => $tutorial->language
                ];
            });

        return Inertia::render('Tutorials/Index', [
            'categories' => $categories
        ]);
    }
}
