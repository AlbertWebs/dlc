<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|url|max:500',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Extract YouTube ID
        $youtubeId = Video::extractYouTubeId($validated['youtube_url']);
        
        if (!$youtubeId) {
            return back()->withErrors(['youtube_url' => 'Invalid YouTube URL. Please provide a valid YouTube video URL.'])->withInput();
        }

        $validated['youtube_id'] = $youtubeId;
        $validated['thumbnail_url'] = Video::getYouTubeThumbnail($youtubeId);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Video::create($validated);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|url|max:500',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Extract YouTube ID if URL changed
        if ($validated['youtube_url'] !== $video->youtube_url) {
            $youtubeId = Video::extractYouTubeId($validated['youtube_url']);
            
            if (!$youtubeId) {
                return back()->withErrors(['youtube_url' => 'Invalid YouTube URL. Please provide a valid YouTube video URL.'])->withInput();
            }

            $validated['youtube_id'] = $youtubeId;
            $validated['thumbnail_url'] = Video::getYouTubeThumbnail($youtubeId);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $video->update($validated);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
}
