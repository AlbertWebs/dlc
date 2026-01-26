<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::where('is_active', true);

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Get featured videos
        $featuredVideos = Video::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get all videos with pagination
        $videos = $query->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Get unique categories
        $categories = Video::where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        return view('pages.videos', compact('videos', 'featuredVideos', 'categories'));
    }
}
