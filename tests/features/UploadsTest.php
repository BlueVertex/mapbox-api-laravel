<?php

namespace BlueVertex\MapBoxAPILaravel\Tests;

use BlueVertex\MapBoxAPILaravel\Tests\TestCase;
use BlueVertex\MapBoxAPILaravel\Models\S3Credentials;
use Mapbox;

/**
* Test working with a tileset
*/
class UploadsTest extends TestCase
{
    public function testUploads()
    {
        $credentials = Mapbox::uploads()->credentials();

        $this->assertInstanceOf(S3Credentials::class, $credentials);

        // Create Upload:
        $response = Mapbox::uploads()->create([
            'tileset' => $this->testUsername . '.mytilesetid',
            'url' => "mapbox://datasets/$this->testUsername/$this->testDataset",
            'name' => 'Test Upload'
        ]);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('owner', $response);
        $this->assertContains($this->testUsername, $response);

        $uploadID = $response['id'];

        //List Upload Statuses:
        $list = Mapbox::uploads()->list();
        $this->assertTrue(count($list) > 0);

        //Retrieve Upload Status:
        $response = Mapbox::uploads($uploadID)->get();

        $this->assertArrayHasKey('complete', $response);

        while (isset($response['complete']) && $response['complete'] != true)
        {
            sleep(1);

            $response = Mapbox::uploads($uploadID)->get();
        }

        //Delete Upload:
        $response = Mapbox::uploads($uploadID)->delete();

        $this->assertEquals(204, $response->status());
    }
}
