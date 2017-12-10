<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use Mapbox;

/**
* Test submitting a dataset
*/
class DataSetTest extends TestCase
{
    public function testListDataSet()
    {
        $response = Mapbox::datasets()->list();

        $this->assertEquals(is_array($response), true);
    }

    public function testCreateAndDeleteDataSet()
    {
        $response = Mapbox::datasets()->create([
            "name" => "foo",
            "description" => "bar"
        ]);

        $this->assertArrayHasKey('owner', $response);

        $response = Mapbox::datasets()->delete($response['id']);

        $this->assertEquals(204, $response->status());
    }
}
