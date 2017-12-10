<?php

namespace BlueVertex\MapBoxAPILaravel;

use Illuminate\Config\Repository as Config;
use Zttp\Zttp;
use Zttp\ZttpResponse;

class Mapbox
{
    /**
     * Request Types
     */
    const DATASET = 'datasets';
    const TILESET = 'tilesets';

    /**
     * Config Values
     * @var object
     */
    private $mconfig;

    /**
     * Current Data Type
     * @var string
     */
    private $currentType;

    public function __construct(Config $config)
    {
        if ($config->has('mapbox::config'))
        {
            $this->mconfig = $config->get('mapbox::config');
        }
        else if ($config->get('mapbox'))
        {
            $this->mconfig = $config->get('mapbox');
        }
        else
        {
            throw new RunTimeException('No config found');
        }
    }

    public function test()
    {
        return $this;
    }

    protected function getUrl($type, $id = null, $options = [])
    {
        $parts = [
            $this->mconfig['api_url'],
            $type,
            $this->mconfig['api_version'],
            $this->mconfig['username']
        ];

        if ($id != null)
        {
            $parts[] = $id;
        }

        if (!empty($options))
        {
            $parts = array_merge($parts, $options);
        }

        return ($this->mconfig['use_ssl'] ? 'https://' : 'http://') . implode('/', $parts) . '?access_token=' . $this->mconfig['access_token'];
    }

    public function datasets()
    {
        $this->currentType = Mapbox::DATASET;

        return $this;
    }

    public function list()
    {
        $response = Zttp::get($this->getUrl($this->currentType));

        return $response->json();
    }

    public function create($data)
    {
        $response = Zttp::post($this->getUrl($this->currentType), $data);

        return $response->json();
    }

    public function get($id)
    {
        $response = Zttp::get($this->getUrl($this->currentType, $id));

        return $response->json();
    }

    public function update($id, $data)
    {
        $response = Zttp::patch($this->getUrl($this->currentType, $id), $data);

        return $response->json();
    }

    public function delete($id)
    {
        return Zttp::delete($this->getUrl($this->currentType, $id));
    }

    public function listFeatures($id)
    {
        if ($this->currentType !== Mapbox::DATASET)
        {
            throw new RunTimeException('Features only work with Datasets');
        }

        $response = Zttp::get($this->getUrl($this->currentType, $id, ['features']));

        return $response->json();
    }
}
