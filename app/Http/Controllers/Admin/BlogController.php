<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.blogs.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'source_url' => 'nullable|url|unique:blog_posts,source_url',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'is_published' => 'boolean',
        ]);

        // Generate slug
        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog', 'public');
            $validated['featured_image'] = $path;
        }

        $validated['slug'] = $slug;
        $validated['is_published'] = $request->has('is_published');

        BlogPost::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'source_url' => 'nullable|url|unique:blog_posts,source_url,' . $blog->id,
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'is_published' => 'boolean',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $path = $request->file('featured_image')->store('blog', 'public');
            $validated['featured_image'] = $path;
        }

        // Update slug if title changed
        if ($blog->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_published'] = $request->has('is_published');

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
