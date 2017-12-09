<?php

namespace BlueVertex\MapBoxAPILaravel;

use Illuminate\Support\ServiceProvider;

class MapBoxAPILaravelServiceProvider extends ServiceProvider {

    public function boot() {

    }

    public function register() {

        // $this->app->bind(
        //     'BlueVertex\EMRBridge\Contracts\ResourceQuery',
        //     getenv('EMR_API_MODULE')
        // );

        // $this->app->bind('emrbridge.resource', function () {
        //     return new \BlueVertex\EMRBridge\Resource\Resource;
        // });
    }
}
