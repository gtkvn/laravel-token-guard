<?php

namespace Gtk\LaravelTokenGuard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'laravel-token-guard-migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Auth::extend('token', function($app, $name, array $config) {
            return new TokenGuard(Auth::createUserProvider($config['provider']), $app['request'], $app['encrypter']);
        });
    }
}
