<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'portfolio_file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
            'additional_notes' => 'nullable|string|max:5000',
        ]);

        $timestamp = time();
        $userId = $user->id;
        $paths = [];

        $fileUploads = [
            'cv_file' => ['type' => 'cv', 'folder' => 'applicants/cv'],
            'cover_letter_file' => ['type' => 'coverletter', 'folder' => 'applicants/cl'],
            'portfolio_file' => ['type' => 'portfolio', 'folder' => 'applicants/porto'],
        ];

        foreach ($fileUploads as $requestKey => $details) {

            if ($request->hasFile($requestKey)) {
                $file = $request->file($requestKey);
                $extension = $file->extension();

                $filename = "{$userId}_{$timestamp}_{$details['type']}.{$extension}";

                $paths[$requestKey] = $file->storeAs($details['folder'], $filename, 'public');
            } else {
                $paths[$requestKey] = null;
            }
        }

        $cvPath = $paths['cv_file'];
        $coverLetterPath = $paths['cover_letter_file'];
        $portfolioPath = $paths['portfolio_file'];

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

    public function userApply()
    {
        $userId = Auth::id();

        $applications = JobApplication::where('user_id', $userId)
            ->with('career')
            ->latest()
            ->paginate(10);

        return view('pages.applications.index', [
            'applications' => $applications
        ]);
    }

    public function showUserApply($slug)
    {
        $id = explode('-', $slug)[0];

        $application = JobApplication::with('career')->findOrFail($id);

        $expectedSlug = $this->buildSlug($application);
        if ($slug !== $expectedSlug) {
            return redirect()->route('userApply.show', $expectedSlug);
        }

        if (Auth::id() !== $application->user_id) {
            abort(403, 'Unauthorized access');
        }

        return view('pages.applications.show', compact('application'));
    }

    private function buildSlug($application)
    {
        return $application->id . '-' .
            Str::slug($application->full_name) . '-' .
            Str::slug($application->career->title);
    }
}
