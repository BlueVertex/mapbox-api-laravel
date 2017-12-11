<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use BlueVertex\MapBoxAPILaravel\Models\Dataset;
use Mapbox;

/**
* Test working with a tileset
*/
class TileSetTest extends TestCase
{
    public function testListTileSet()
    {
        $response = Mapbox::tilesets()->list();

        $this->assertEquals(is_array($response), true);
    }
}
