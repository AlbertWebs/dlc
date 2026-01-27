<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    public function show($slug)
    {
        $page = LegalPage::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.legal', compact('page'));
    }
}
