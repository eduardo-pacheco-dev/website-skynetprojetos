<?php

namespace App\Http\Controllers\Site;

use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController
{
    public function __invoke(): View
    {
        abort_unless(Setting::get('construction_enabled', '1') === '1', 404);

        return view('site.construction');
    }
}
