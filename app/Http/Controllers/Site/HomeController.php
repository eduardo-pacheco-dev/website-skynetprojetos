<?php

namespace App\Http\Controllers\Site;

use Illuminate\Contracts\View\View;

class HomeController
{
    public function __invoke(): View
    {
        return view('site.construction');
    }
}
