<?php

namespace App\Providers;

use App\Console\Commands\DuskCommand;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('dusk')) {
            $this->app->bind(
                'App\Services\Message',
                'App\Services\Message\Fake'
            );
        } else {
            $this->app->bind(
                'App\Services\Message',
                'App\Twilio\Services\Message'
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
