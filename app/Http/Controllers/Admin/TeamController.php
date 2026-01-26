<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|string|max:255',
            'credentials' => 'nullable|array',
            'social_links' => 'nullable|array',
            'is_visible' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        // Convert credentials string to array
        if (isset($validated['credentials']) && is_string($validated['credentials'])) {
            $validated['credentials'] = array_filter(array_map('trim', explode("\n", $validated['credentials'])));
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|string|max:255',
            'credentials' => 'nullable|string',
            'social_links' => 'nullable|string',
            'is_visible' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        // Convert credentials string to array
        if (isset($validated['credentials']) && is_string($validated['credentials'])) {
            $validated['credentials'] = array_filter(array_map('trim', explode("\n", $validated['credentials'])));
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
