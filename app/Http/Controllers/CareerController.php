<?php

namespace App\Http\Controllers;

use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::where('status', 'published')->latest()->get();

        return view('pages.careers.index', ['careers' => $careers]);
    }

    public function show(Career $career)
    {
        if ($career->status !== 'published') {
            abort(404);
        }
        return view('pages.careers.show', ['career' => $career]);
    }
}
