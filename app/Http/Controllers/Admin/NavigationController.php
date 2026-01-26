<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        $navigations = Navigation::orderBy('location')->orderBy('order')->get();
        return view('admin.navigations.index', compact('navigations'));
    }

    public function create()
    {
        return view('admin.navigations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'category' => 'nullable|string|max:255',
            'is_visible' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        Navigation::create($validated);

        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigation item created successfully.');
    }

    public function edit(Navigation $navigation)
    {
        return view('admin.navigations.edit', compact('navigation'));
    }

    public function update(Request $request, Navigation $navigation)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'category' => 'nullable|string|max:255',
            'is_visible' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $navigation->update($validated);

        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigation item updated successfully.');
    }

    public function destroy(Navigation $navigation)
    {
        $navigation->delete();

        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigation item deleted successfully.');
    }
}
