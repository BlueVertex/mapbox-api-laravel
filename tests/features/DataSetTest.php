<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use BlueVertex\MapBoxAPILaravel\Models\Dataset;
use Mapbox;

/**
* Test working with a dataset
*/
class DataSetTest extends TestCase
{
    public function testListDataSet()
    {
        $response = Mapbox::datasets()->list();

        $this->assertEquals(is_array($response), true);
    }

    public function testDataSets()
    {
        // Create Dataset
        $response = Mapbox::datasets()->create([
            "name" => "foo",
            "description" => "bar"
        ]);

        $this->assertArrayHasKey('owner', $response);

        // Retrieve Dataset
        $response = Mapbox::datasets()->get($response['id']);

        $this->assertArrayHasKey('owner', $response);

        // Update Dataset
         $response = Mapbox::datasets()->update($response['id'], [
            "name" => "foo2"
        ]);

        $this->assertArrayHasKey('name', $response);
        $this->assertContains('foo2', $response);


        // Delete Dataset (clean up)
        $response = Mapbox::datasets()->delete($response['id']);

        $this->assertEquals(204, $response->status());
    }
}
