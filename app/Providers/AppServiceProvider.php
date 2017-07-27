<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Bind the NeoRepository to NeoContract
        $this->app->bind(
            'App\Repositories\Contracts\NeoContract',
            'App\Repositories\NeoRepository'
        );

        //Bind the FeedRepository to FeedContract
        $this->app->bind(
            'App\Repositories\Contracts\FeedContract',
            'App\Repositories\FeedRepository'
        );
    }
}
