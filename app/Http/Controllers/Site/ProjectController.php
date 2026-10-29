<?php

namespace App\Http\Controllers\Site;

use App\Models\Project;
use Illuminate\Contracts\View\View;

class ProjectController
{
    public function index(): View
    {
        return view('site.projects.index', [
            'projects' => Project::query()
                ->active()
                ->ordered()
                ->paginate(9)
                ->withQueryString(),
        ]);
    }

    public function show(Project $project): View
    {
        abort_unless($project->is_active, 404);

        $relatedProjects = Project::query()
            ->active()
            ->whereKeyNot($project->getKey())
            ->ordered()
            ->take(3)
            ->get();

        return view('site.projects.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
        ]);
    }
}
