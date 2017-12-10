<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use BlueVertex\MapBoxAPILaravel\Models\Dataset;
use Mapbox;

/**
* Test Features
*/
class FeaturesTest extends TestCase
{
    public function testFeatures()
    {
        $response = Mapbox::datasets()->listFeatures($this->testDataset);

        $this->assertArrayHasKey('features', $response);
        $this->assertContains('FeatureCollection', $response);
    }
}
