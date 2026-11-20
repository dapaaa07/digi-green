<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
