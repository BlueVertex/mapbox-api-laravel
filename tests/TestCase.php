<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
* Test submitting a dataset
*/
class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return ['BlueVertex\MapBoxAPILaravel\MapBoxAPILaravelServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Mapbox' => 'BlueVertex\MapBoxAPILaravel\Facades\Mapbox'
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        if (file_exists(dirname(__DIR__) . '/.env.test')) {
            (new \Dotenv\Dotenv(dirname(__DIR__), '.env.test'))->load();
        }

        $app['config']->set('mapbox', [
            'api_url'      => 'api.mapbox.com',
            'api_version'  => 'v1',
            'use_ssl'      => true,
            'username'     => getenv('MAPBOX_USERNAME'),
            'access_token' => getenv('MAPBOX_ACCESS_TOKEN')
        ]);
    }
}
