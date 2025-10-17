<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class JobApplicationController extends Controller
{
    public function create(Career $career)
    {
        if ($career->status !== 'published') {
            abort(404);
        }
        $user = Auth::user();
        $alreadyApplied = JobApplication::where('user_id', $user->id)
            ->where('career_id', $career->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->route('careers.show', $career)
                ->with('error', 'You have already applied for this position.');
        }

        return view('pages.careers.apply', compact('career'));
    }

    public function store(Request $request, Career $career)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'additional_notes' => 'nullable|string|max:5000',
        ]);

        $timestamp = time();

        $cv = $request->file('cv_file');
        $cvFilename = "{$user->id}_{$timestamp}_cv_{$cv->getClientOriginalName()}";
        $cvPath = $cv->storeAs('applicants/cv', $cvFilename, 'public');

        $coverLetterPath = null;
        if ($request->hasFile('cover_letter_file')) {
            $cl = $request->file('cover_letter_file');
            $clFilename = "{$user->id}_{$timestamp}_coverletter_{$cl->getClientOriginalName()}";
            $coverLetterPath = $cl->storeAs('applicants/cl', $clFilename, 'public');
        }

        $portfolioPath = null;
        if ($request->hasFile('portfolio_file')) {
            $pf = $request->file('portfolio_file');
            $pfFilename = "{$user->id}_{$timestamp}_portfolio_{$pf->getClientOriginalName()}";
            $portfolioPath = $pf->storeAs('applicants/porto', $pfFilename, 'public');
        }
        
        JobApplication::create([
            'career_id' => $career->id,
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cv_file' => $cvPath,
            'cover_letter_file' => $coverLetterPath,
            'portfolio_file' => $portfolioPath,
            'additional_notes' => $validated['additional_notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('careers.show', $career)
            ->with('success', 'Your application has been submitted successfully!');
    }
}
