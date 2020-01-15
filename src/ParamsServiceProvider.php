<?php

namespace ElephantsGroup\Params;

use Illuminate\Support\ServiceProvider;
use ElephantsGroup\Params\Commands\Params;

class ParamsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/params.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'params');
        $this->loadViewsFrom(__DIR__ . '/Views', 'params');
        $this->publishes([__DIR__ . '/Assets' => public_path('vendor/params'),], 'public');
        if ($this->app->runningInConsole())
        {
            $this->commands([
                Commands\CreateParameter::class,
            ]);
        }   
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('params', 'ElaphantsGroup\Params\Params');

        $config = __DIR__ . '/Config/params.php';
        $this->mergeConfigFrom($config, 'params');

        $this->publishes([__DIR__ . '/Config/params.php' => config_path('params.php')], 'config');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/params'),
        ]);

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/params'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/params'),
        ], 'public');

        $this->publishes([
            realpath(__DIR__ . '/Database/Migrations') => $this->app->databasePath() . '/migrations',
        ], 'migrations');
    }
}
