<?php

namespace App\Http\Controllers\Site;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class HomeController
{
    public function __invoke(): View
    {
        return view('site.home', [
            'services' => Service::query()->active()->ordered()->take(6)->get(),
            'featuredProjects' => Project::query()
                ->active()
                ->where('is_featured', true)
                ->ordered()
                ->take(3)
                ->get(),
        ]);
    }
}
