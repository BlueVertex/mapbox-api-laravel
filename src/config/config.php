<?php

/**
 * Create your MapBox API Access Token at https://www.mapbox.com/
 */

return [
    'debug'               => function_exists('env') ? env('APP_DEBUG', false) : false,
    'api_url'             => 'api.mapbox.com',
    'api_version'         => 'v1',
    'use_ssl'             => true,
    'access_token'        => function_exists('env') ? env('MAPBOX_ACCESS_TOKEN', '') : '',
    'username'            => function_exists('env') ? env('MAPBOX_USERNAME', '') : ''
];
