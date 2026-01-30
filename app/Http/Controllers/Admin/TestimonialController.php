<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleReviewsService;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            try {
                $photoPath = $request->file('photo')->store('testimonials', 'public');
                $validated['photo'] = $photoPath;
            } catch (\Exception $e) {
                return redirect()->route('admin.testimonials.create')
                    ->withErrors(['photo' => 'ERROR uploading photo: ' . $e->getMessage()])
                    ->withInput();
            }
        } else {
            unset($validated['photo']);
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            try {
                // Delete old photo if exists
                if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                    Storage::disk('public')->delete($testimonial->photo);
                }
                $photoPath = $request->file('photo')->store('testimonials', 'public');
                $validated['photo'] = $photoPath;
            } catch (\Exception $e) {
                return redirect()->route('admin.testimonials.edit', $testimonial)
                    ->withErrors(['photo' => 'ERROR uploading photo: ' . $e->getMessage()])
                    ->withInput();
            }
        } else {
            // Keep existing photo if no new one uploaded
            unset($validated['photo']);
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Delete photo if exists
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function syncGoogleReviews()
    {
        try {
            $service = new GoogleReviewsService();
            
            // Check configuration first
            $apiKey = \App\Models\Setting::get('google_places_api_key', '');
            $placeId = \App\Models\Setting::get('google_place_id', '');
            
            if (empty($apiKey)) {
                return redirect()->route('admin.testimonials.index')
                    ->with('error', 'Google Places API Key is not configured. Please set it in Admin → Settings → Google Reviews Integration');
            }
            
            if (empty($placeId)) {
                return redirect()->route('admin.testimonials.index')
                    ->with('error', 'Google Place ID is not configured. Please set it in Admin → Settings → Google Reviews Integration');
            }
            
            $result = $service->syncReviews(true);
            
            if (!empty($result['message']) && $result['synced'] === 0 && ($result['total'] ?? 0) === 0) {
                $errorMessage = $result['message'];
                if (isset($result['error_details'])) {
                    $errorMessage .= ' Details: ' . $result['error_details'];
                }
                return redirect()->route('admin.testimonials.index')
                    ->with('error', $errorMessage);
            }
            
            $message = '';
            if (($result['synced'] ?? 0) > 0) {
                $message = "Successfully synced {$result['synced']} review(s) from Google.";
            } else {
                $message = "No new reviews were synced.";
            }
            
            if (($result['total'] ?? 0) > 0) {
                $message .= " Total reviews fetched: {$result['total']}.";
            } else {
                $message .= " No reviews found. Please check your Google Business Profile has reviews.";
            }
            
            return redirect()->route('admin.testimonials.index')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            \Log::error('Error syncing Google reviews: ' . $e->getMessage());
            return redirect()->route('admin.testimonials.index')
                ->with('error', 'An error occurred while syncing Google reviews: ' . $e->getMessage());
        }
    }
}
