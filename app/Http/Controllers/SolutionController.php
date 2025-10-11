<?php

namespace App\Http\Controllers;

use App\Models\Solution;

class SolutionController extends Controller
{

    public function index()
    {
        $solutions = Solution::where('status', 'published')
            ->latest('published_at')
            ->get();

        $groupedSolutions = $solutions->groupBy('category');

        return view('pages.solutions.index', compact('groupedSolutions'));
    }

    public function category($category)
    {
        $validCategories = ['service', 'infrastructure', 'product'];
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $solutions = Solution::where('status', 'published')
            ->where('category', $category)
            ->latest('published_at')
            ->paginate(9);

        return view('pages.solutions.category', compact('solutions', 'category'));
    }
    public function show($category, Solution $solution)
    {
        if ($solution->category !== $category) {
            abort(404);
        }

        return view('pages.solutions.show', compact('solution'));
    }
}