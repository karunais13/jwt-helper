<?php

namespace Karu\JWTHelper;

use Illuminate\Support\ServiceProvider;

class JWTHelperProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/jwttoken.php' => config_path('jwttoken.php'),
        ]);
    }
}