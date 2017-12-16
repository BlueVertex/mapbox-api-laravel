<?php

namespace BlueVertex\MapBoxAPILaravel;

use Illuminate\Support\ServiceProvider;
use BlueVertex\MapBoxAPILaravel\Mapbox;

class MapBoxAPILaravelServiceProvider extends ServiceProvider {

    public function boot() {

        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__.'/config/config.php' => config_path('mapbox.php'),
            ]);
        }
    }

    public function register() {

        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'mapbox'
        );

        $this->app->singleton(Mapbox::class, function ($app) {
            return new Mapbox($app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mapbox'];
    }
}
