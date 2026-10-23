<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()
            ->orderBy('order')
            ->get();

        return view('work', compact('projects'));
    }

    public function show(string $slug)
    {
        $project = Project::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $siblings = Project::published()->orderBy('order')->get(['id', 'title', 'slug']);
        $index = $siblings->search(fn ($p) => $p->id === $project->id);
        $next = $siblings->count() > 1 ? $siblings[($index + 1) % $siblings->count()] : null;

        return view('project', compact('project', 'next'));
    }
}
