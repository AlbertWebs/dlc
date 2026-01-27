<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        try {
            $teamMembers = TeamMember::where('is_visible', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $teamMembers = collect([]);
        }
        return view('pages.about', compact('teamMembers'));
    }

    public function events()
    {
        try {
            $events = Event::where('is_published', true)
                ->where('event_date', '>=', now())
                ->orderBy('event_date')
                ->get();
        } catch (\Exception $e) {
            $events = collect([]);
        }
        return view('pages.events', compact('events'));
    }

    public function becomeACoach()
    {
        return view('pages.become-a-coach');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                // Handle form submission
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'subject' => 'required|string|max:255',
                    'message' => 'required|string',
                    'phone' => 'nullable|string|max:255',
                    'program' => 'nullable|string|max:255',
                    'experience' => 'nullable|string|max:255',
                    'consent' => 'required|accepted',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Handle AJAX validation errors
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please fill in all required fields correctly.',
                        'errors' => $e->errors()
                    ], 422);
                }
                throw $e;
            }

            try {
                // Get recipient email from settings or use default
                $recipientEmail = Setting::get('email', 'info@dlc.co.ke');
                
                // Build email content
                $emailContent = "New Contact Form Submission\n\n";
                $emailContent .= "Subject: " . $request->subject . "\n";
                $emailContent .= "From: " . $request->name . " <" . $request->email . ">\n";
                if ($request->phone) {
                    $emailContent .= "Phone: " . $request->phone . "\n";
                }
                if ($request->program) {
                    $emailContent .= "Program: " . $request->program . "\n";
                }
                if ($request->experience) {
                    $emailContent .= "Coaching Experience: " . $request->experience . "\n";
                }
                $emailContent .= "\nMessage:\n" . $request->message . "\n";
                
                // Send email
                Mail::raw($emailContent, function ($message) use ($recipientEmail, $request) {
                    $message->to($recipientEmail)
                            ->subject($request->subject)
                            ->replyTo($request->email, $request->name);
                });
                
                // Handle AJAX requests
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Thank you for your application! We will get back to you soon.'
                    ]);
                }
                
                // Determine redirect based on where the form was submitted from
                if ($request->has('program')) {
                    // If coming from program detail page, redirect back with success
                    return back()->with('success', 'Thank you for your message! We will get back to you soon.');
                }
                
                return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Email sending failed: ' . $e->getMessage());
                
                // Handle AJAX requests
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'There was an error sending your application. Please try again or contact us directly.'
                    ], 500);
                }
                
                // Still redirect with success (email might be logged instead)
                if ($request->has('program')) {
                    return back()->with('success', 'Thank you for your message! We will get back to you soon.');
                }
                
                return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
            }
        }

        return view('pages.contact');
    }

    public function programs()
    {
        try {
            $programs = Program::where('is_published', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $programs = collect([]);
        }
        return view('pages.programs', compact('programs'));
    }

    public function showProgram($slug)
    {
        try {
            $program = Program::where('slug', $slug)->where('is_published', true)->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }
        return view('pages.program-detail', compact('program'));
    }
}

