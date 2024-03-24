<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PosViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path('pos_views'), 'pos');
    }
}
