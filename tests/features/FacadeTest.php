<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use Mapbox as MapboxFacade;
use BlueVertex\MapBoxAPILaravel\Mapbox;

/**
* Test submitting a dataset
*/
class FacadeTest extends TestCase
{
    public function testFacadeExists()
    {
        $this->assertInstanceOf(Mapbox::class, MapboxFacade::test());
    }
}
