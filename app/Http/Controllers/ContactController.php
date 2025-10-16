<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function create()
    {
        $partners = Partner::all();
        return view('pages.contact', ['partners' => $partners]);
    }

    public function store(Request $request)
    {
        $ipAddress = $request->ip();
        $name = $request->input('name');
        $email = $request->input('email');

        $lastMessage = ContactMessage::where(function ($query) use ($ipAddress, $name, $email) {
            $query->where('ip_address', $ipAddress)
                ->orWhere('name', $name)
                ->orWhere('email', $email);
        })->latest()->first();

        if ($lastMessage && $lastMessage->created_at->gt(Carbon::now()->subSeconds(60))) {

            $roundedSecondsLeft = (int) max(1, 60 - $lastMessage->created_at->diffInSeconds(Carbon::now()));

            $errorMessage = "To prevent duplicate submissions, our system requires a short waiting period. Please try again in {$roundedSecondsLeft} seconds.";

            return back()
                ->withInput()
                ->withErrors(['error' => $errorMessage]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        ContactMessage::create($validated);

        return redirect()->to(url()->previous() . '#contact')->with('success', 'Your message has been sent successfully!');
    }

}
