<?php

namespace App\Providers;

use BRCas\CA\Contracts\Event\EventManagerInterface;
use Illuminate\Support\ServiceProvider;
use System\Application\EventManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(EventManagerInterface::class, EventManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
