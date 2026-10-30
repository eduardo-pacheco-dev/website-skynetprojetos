<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());

        Carbon::setLocale(config('app.locale'));

        View::composer(
            'site.*',
            function (ViewInstance $view): void {
                $view->with('siteSettings', Setting::values());
            },
        );
    }
}
