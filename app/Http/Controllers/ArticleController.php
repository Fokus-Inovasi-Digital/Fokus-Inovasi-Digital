<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $currentCategory = $request->query('category');
        $validCategories = ['article', 'activity', 'csr'];

        $articlesQuery = Article::where('status', 'published');

        if ($currentCategory && in_array($currentCategory, $validCategories)) {
            $articlesQuery->where('category', $currentCategory);
        }

        $articles = $articlesQuery->latest('published_at')
            ->paginate(9)->withQueryString();

        return view('pages.articles.index', compact('articles', 'currentCategory'));
    }
    public function show(Article $article)
    {
        $relatedArticles = Article::where('category', $article->category)
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'relatedArticles'));
    }

}
