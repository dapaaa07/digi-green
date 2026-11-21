<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->input('status') === 'published') {
                $query->where('is_published', true);
            } elseif ($request->input('status') === 'draft') {
                $query->where('is_published', false);
            }
        }

        $articles = $query->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'thumbnail' => 'nullable|string|max:500',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $thumbnailPath = $validated['thumbnail'] ?? 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1200&q=80';
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('articles', 'public');
            $thumbnailPath = '/storage/' . $path;
        }

        $slug = Str::slug($validated['title']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }

        $isPublished = $request->boolean('is_published');
        $publishedAt = null;
        if ($isPublished) {
            $publishedAt = $request->filled('published_at')
                ? Carbon::parse($request->input('published_at'))
                : now();
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => $uniqueSlug,
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'thumbnail' => $thumbnailPath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Berita / kabar desa baru berhasil ditambahkan.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'thumbnail' => 'nullable|string|max:500',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $thumbnailPath = $article->thumbnail;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('articles', 'public');
            $thumbnailPath = '/storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $thumbnailPath = $validated['thumbnail'];
        }

        $slug = Str::slug($validated['title']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $uniqueSlug)->where('id', '!=', $article->id)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }

        $isPublished = $request->boolean('is_published');
        $publishedAt = null;
        if ($isPublished) {
            $publishedAt = $request->filled('published_at')
                ? Carbon::parse($request->input('published_at'))
                : ($article->published_at ?? now());
        }

        $article->update([
            'title' => $validated['title'],
            'slug' => $uniqueSlug,
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'author' => $validated['author'],
            'thumbnail' => $thumbnailPath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Berita "' . $article->title . '" berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $title = $article->title;
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Berita "' . $title . '" berhasil dihapus.');
    }
}
