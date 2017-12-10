<?php

namespace BlueVertex\MapBoxAPILaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Mapbox extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'BlueVertex\MapBoxAPILaravel\Mapbox'; }

}
