<?php

namespace App\Http\Controllers\Site;

use Illuminate\Contracts\View\View;

class AboutController
{
    public function __invoke(): View
    {
        return view('site.about');
    }
}
