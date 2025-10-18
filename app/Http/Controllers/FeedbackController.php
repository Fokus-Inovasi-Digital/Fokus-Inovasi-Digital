<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function create()
    {
        $types = $this->getFeedbackTypes();

        return view('pages.feedback.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'type' => [
                'required',
                Rule::in(array_keys($this->getFeedbackTypes()))
            ],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'type' => $validated['type'],
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()
            ->route('feedback.create')
            ->with('success', 'Thank you! Your feedback has been submitted successfully.');
    }

    /**
     * Get available feedback types.
     *
     * @return array
     */
    private function getFeedbackTypes(): array
    {
        return [
            'bug' => 'Bug Report',
            'feature_request' => 'Feature Request',
            'improvement' => 'Improvement Suggestion',
            'compliment' => 'Compliment / Testimonial',
            'complaint' => 'Complaint',
            'other' => 'Other',
        ];
    }
}
