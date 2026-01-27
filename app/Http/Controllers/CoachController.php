<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('pages.coaches', compact('coaches'));
    }

    public function show($slug)
    {
        $coach = Coach::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.coach-profile', compact('coach'));
    }
}
