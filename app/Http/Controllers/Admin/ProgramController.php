<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:programs,slug',
            'description' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'features' => 'nullable|string',
            'meta' => 'nullable|array',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_published'] = $request->has('is_published');
        $validated['currency'] = $validated['currency'] ?? 'KES';

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('programs', 'public');
                $validated['image'] = $imagePath;
            } catch (\Exception $e) {
                return redirect()->route('admin.programs.create')
                    ->withErrors(['image' => 'ERROR uploading image: ' . $e->getMessage()])
                    ->withInput();
            }
        } else {
            unset($validated['image']);
        }

        // Convert features string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        Program::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:programs,slug,' . $program->id,
            'description' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'features' => 'nullable|string',
            'meta' => 'nullable|array',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_published'] = $request->has('is_published');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists and is stored locally
                if ($program->image && !str_starts_with($program->image, 'http') && Storage::disk('public')->exists($program->image)) {
                    Storage::disk('public')->delete($program->image);
                }
                $imagePath = $request->file('image')->store('programs', 'public');
                $validated['image'] = $imagePath;
            } catch (\Exception $e) {
                return redirect()->route('admin.programs.edit', $program)
                    ->withErrors(['image' => 'ERROR uploading image: ' . $e->getMessage()])
                    ->withInput();
            }
        } else {
            // Keep existing image if no new one uploaded
            unset($validated['image']);
        }

        // Convert features string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
