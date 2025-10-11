<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles.index', compact('articles'));
    }

    public function category(string $category)
    {
        $allowedCategories = ['article', 'activity', 'csr'];
        if (!in_array($category, $allowedCategories)) {
            abort(404);
        }

        $articles = Article::where('category', $category)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles.index', [
            'articles' => $articles,
            'currentCategory' => $category
        ]);
    }

    public function show(string $category, string $slug)
    {
        $allowedCategories = ['article', 'activity', 'csr'];
        if (!in_array($category, $allowedCategories)) {
            abort(404);
        }

        $article = Article::where('category', $category)
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedArticles = Article::where('category', $article->category)
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'relatedArticles'));
    }

}
