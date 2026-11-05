<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Tampilkan landing page publik.
     */
    public function landing()
    {
        // 3 produk aktif
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('name')
            ->take(3)
            ->get();

        // 3 artikel terbit terbaru
        $latestArticles = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('landing', compact('featuredProducts', 'latestArticles'));
    }

    /**
     * Tampilkan arsip artikel publik.
     */
    public function articlesIndex(Request $request)
    {
        $query = Article::where('is_published', true);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->orderByDesc('published_at')->paginate(9);

        return view('articles.index', compact('articles'));
    }

    /**
     * Tampilkan detail artikel publik.
     */
    public function articlesShow($id)
    {
        $article = Article::where('is_published', true)->findOrFail($id);

        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
