<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CompanyProfile;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();
        $partners = Partner::all();
        $articles = Article::where('status', 'published')->orderBy('published_at', 'desc')->take(3)->get();

        $name = $company->company_name;
        $words = explode(' ', $name);

        $p1 = implode(' ', array_slice($words, 0, 2));
        $p2 = implode(' ', array_slice($words, 2));

        return view('pages.home', compact('company', 'partners', 'articles', 'p1', 'p2'));
    }

    public function about()
    {
        return view('pages.about');
    }
}
