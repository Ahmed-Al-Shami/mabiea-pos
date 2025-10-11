<?php

namespace App\Providers;

use App\Support\UrlGenerator\FixedUrlGenerator;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\Support\UrlGenerator\UrlGeneratorFactory;

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

    }
}
