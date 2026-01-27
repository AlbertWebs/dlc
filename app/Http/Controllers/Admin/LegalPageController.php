<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LegalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = LegalPage::orderBy('type')->orderBy('created_at', 'desc')->get();
        return view('admin.legal-pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.legal-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:privacy,terms',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:legal_pages,slug',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_published'] = $request->has('is_published');

        LegalPage::create($validated);

        return redirect()->route('admin.legal-pages.index')
            ->with('success', 'Legal page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalPage $legalPage)
    {
        return view('admin.legal-pages.show', compact('legalPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalPage $legalPage)
    {
        return view('admin.legal-pages.edit', compact('legalPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LegalPage $legalPage)
    {
        $validated = $request->validate([
            'type' => 'required|in:privacy,terms',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:legal_pages,slug,' . $legalPage->id,
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_published'] = $request->has('is_published');

        $legalPage->update($validated);

        return redirect()->route('admin.legal-pages.index')
            ->with('success', 'Legal page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalPage $legalPage)
    {
        $legalPage->delete();

        return redirect()->route('admin.legal-pages.index')
            ->with('success', 'Legal page deleted successfully.');
    }
}
