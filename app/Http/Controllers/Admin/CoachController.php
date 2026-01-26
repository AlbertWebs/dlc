<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        return view('admin.coaches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:coaches,slug',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'credentials' => 'nullable|string',
            'specializations' => 'nullable|string',
            'social_links' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'certifications' => 'nullable|string',
            'coaching_style' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Coach::generateSlug($validated['name']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        // Convert credentials string to array
        if (isset($validated['credentials']) && is_string($validated['credentials'])) {
            $validated['credentials'] = array_filter(array_map('trim', explode("\n", $validated['credentials'])));
        }

        // Convert specializations string to array
        if (isset($validated['specializations']) && is_string($validated['specializations'])) {
            $validated['specializations'] = array_filter(array_map('trim', explode("\n", $validated['specializations'])));
        }

        // Convert social links string to array (format: platform:url)
        if (isset($validated['social_links']) && is_string($validated['social_links'])) {
            $links = [];
            foreach (explode("\n", $validated['social_links']) as $line) {
                $line = trim($line);
                if (strpos($line, ':') !== false) {
                    [$platform, $url] = explode(':', $line, 2);
                    $links[trim($platform)] = trim($url);
                }
            }
            $validated['social_links'] = !empty($links) ? $links : null;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Coach::create($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach created successfully.');
    }

    public function edit(Coach $coach)
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    public function update(Request $request, Coach $coach)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:coaches,slug,' . $coach->id,
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'credentials' => 'nullable|string',
            'specializations' => 'nullable|string',
            'social_links' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'certifications' => 'nullable|string',
            'coaching_style' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Coach::generateSlug($validated['name']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
                Storage::disk('public')->delete($coach->photo);
            }
            $validated['photo'] = $request->file('photo')->store('coaches', 'public');
        } elseif ($request->has('delete_photo') && $request->delete_photo) {
            // Delete photo if checkbox is checked
            if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
                Storage::disk('public')->delete($coach->photo);
            }
            $validated['photo'] = null;
        }

        // Convert credentials string to array
        if (isset($validated['credentials']) && is_string($validated['credentials'])) {
            $validated['credentials'] = array_filter(array_map('trim', explode("\n", $validated['credentials'])));
        }

        // Convert specializations string to array
        if (isset($validated['specializations']) && is_string($validated['specializations'])) {
            $validated['specializations'] = array_filter(array_map('trim', explode("\n", $validated['specializations'])));
        }

        // Convert social links string to array
        if (isset($validated['social_links']) && is_string($validated['social_links'])) {
            $links = [];
            foreach (explode("\n", $validated['social_links']) as $line) {
                $line = trim($line);
                if (strpos($line, ':') !== false) {
                    [$platform, $url] = explode(':', $line, 2);
                    $links[trim($platform)] = trim($url);
                }
            }
            $validated['social_links'] = !empty($links) ? $links : null;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $coach->update($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach updated successfully.');
    }

    public function destroy(Coach $coach)
    {
        // Delete photo if exists
        if ($coach->photo && Storage::disk('public')->exists($coach->photo)) {
            Storage::disk('public')->delete($coach->photo);
        }

        $coach->delete();

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Coach deleted successfully.');
    }
}
