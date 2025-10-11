<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;

class AboutController extends Controller
{
    public function index()
    {
        $cp = CompanyProfile::first();
        return view('pages.about', compact('cp'));
    }
}
