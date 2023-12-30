<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PersonService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PersonService::class, function ($app) {
            return new PersonService();
        });    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
