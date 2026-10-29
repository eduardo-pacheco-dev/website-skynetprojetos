<?php

namespace App\Providers;

use App\Models\Service;
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
            ['site.*', 'components.site.*', 'components.layouts.site'],
            function (ViewInstance $view): void {
                $view->with('siteSettings', Setting::values());
            },
        );

        View::composer(
            'components.layouts.site',
            function (ViewInstance $view): void {
                $view->with('footerServices', Service::query()->active()->ordered()->take(5)->get());
            },
        );
    }
}
