<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function show($slug)
    {
        $coach = Coach::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.coach-profile', compact('coach'));
    }
}
