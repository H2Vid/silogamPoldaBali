<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // tweak so Docker will recognize the non-https proxified request, and force them to https
        if (config('app.force_https')) {
            URL::forceScheme('https');
        }
        if (config('app.proxy_url')) {
            URL::forceRootUrl(config('app.proxy_url'));
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
    }
}
