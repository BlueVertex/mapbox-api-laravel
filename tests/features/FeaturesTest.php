<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use BlueVertex\MapBoxAPILaravel\Models\Dataset;
use GeoJson\Feature\Feature;
use GeoJson\Geometry\Point;
use Mapbox;

/**
* Test Features
*/
class FeaturesTest extends TestCase
{
    public function testFeatures()
    {
        // List
        $response = Mapbox::datasets($this->testDataset)->features()->list();

        $this->assertArrayHasKey('features', $response);
        $this->assertContains('FeatureCollection', $response);

        // Insert/Update
        $testID = 'testfeature';
        $point = new Point([39.9831302,-83.1309135]);
        $feature = new Feature($point, null, $testID);
        $response = Mapbox::datasets($this->testDataset)->features($testID)->add($feature);

        $this->assertArrayHasKey('type', $response);
        $this->assertContains('Feature', $response);

        // Retrieve
        $response = Mapbox::datasets($this->testDataset)->features($testID)->get();

        $this->assertArrayHasKey('type', $response);
        $this->assertContains('Feature', $response);

        // Delete
        $response = Mapbox::datasets($this->testDataset)->features($testID)->delete();

        $this->assertEquals(204, $response->status());
    }
}
