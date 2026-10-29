<?php

namespace App\Http\Controllers\Site;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController
{
    public function index(): View
    {
        return view('site.services.index', [
            'services' => Service::query()->active()->ordered()->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $otherServices = Service::query()
            ->active()
            ->whereKeyNot($service->getKey())
            ->ordered()
            ->take(3)
            ->get();

        return view('site.services.show', [
            'service' => $service,
            'otherServices' => $otherServices,
        ]);
    }
}
