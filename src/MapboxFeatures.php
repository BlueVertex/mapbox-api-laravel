<?php

namespace BlueVertex\MapBoxAPILaravel;

use Zttp\Zttp;
use Zttp\ZttpResponse;
use \BlueVertex\MapBoxAPILaravel\Mapbox;
use \BlueVertex\MapBoxAPILaravel\Facades\Mapbox as MapboxFacade;
use GeoJson\Feature\Feature;

/**
* Mapbox feature class
*/
class MapboxFeatures
{
    const TYPE = 'features';

    private $datasetID;
    private $featureID;

    public function __construct($datasetID, $featureID = null)
    {
        $this->datasetID = $datasetID;
        $this->featureID = $featureID;
    }

    private function request($options = [])
    {
        return MapboxFacade::getUrl(Mapbox::DATASET, $this->datasetID, $options);
    }

    public function list()
    {
        $response = Zttp::get($this->request([
            MapboxFeatures::TYPE
        ]));

        return $response->json();
    }

    public function add(Feature $feature)
    {
        if ($this->featureID == null)
        {
            throw new RunTimeException('Feature ID Required');
        }

        $response = Zttp::put($this->request([
            MapboxFeatures::TYPE,
            $this->featureID
        ]), $feature);

        return $response->json();
    }

    public function get()
    {
        if ($this->featureID == null)
        {
            throw new RunTimeException('Feature ID Required');
        }

        $response = Zttp::get($this->request([
            MapboxFeatures::TYPE,
            $this->featureID
        ]));

        return $response->json();
    }

    public function delete()
    {
        if ($this->featureID == null)
        {
            throw new RunTimeException('Feature ID Required');
        }

        $response = Zttp::delete($this->request([
            MapboxFeatures::TYPE,
            $this->featureID
        ]));

        return $response;
    }
}
