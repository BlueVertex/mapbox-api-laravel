<?php

namespace BlueVertex\MapBoxAPILaravel;

use RunTimeException;
use Illuminate\Config\Repository as Config;
use Zttp\Zttp;
use Zttp\ZttpResponse;
use \BlueVertex\MapBoxAPILaravel\MapboxFeatures;
use \BlueVertex\MapBoxAPILaravel\Models\S3Credentials;

class Mapbox
{
    /**
     * Request Types
     */
    const DATASET = 'datasets';
    const TILESET = 'tilesets';
    const UPLOAD  = 'uploads';

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

    private $id;

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

    public function getUrl($type, $id = null, $options = [])
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

    /**
     * Set API to work with Datasets
     * @param  string $id    Optional
     * @return Mapbox Class
     */
    public function datasets($id = null)
    {
        $this->currentType = Mapbox::DATASET;
        $this->id = $id;

        return $this;
    }

    /**
     * Set API to work with Tilesets
     * @param  string $id    Optional
     * @return Mapbox Class
     */
    public function tilesets($id = null)
    {
        $this->currentType = Mapbox::TILESET;
        $this->id = $id;

        return $this;
    }

    /**
     * Set API to work with Uploads
     * @param  string $id    Optional
     * @return Mapbox Class
     */
    public function uploads($id = null)
    {
        $this->currentType = Mapbox::UPLOAD;
        $this->id = $id;

        return $this;
    }

    public function list($options = [])
    {
        if (count($options) && $this->currentType == Mapbox::DATASET)
        {
            throw new RunTimeException('Dataset listing does not support parameters');
        }

        $response = Zttp::get($this->getUrl($this->currentType), $options);

        return $response->json();
    }

    public function create($data)
    {
        $response = Zttp::post($this->getUrl($this->currentType), $data);

        return $response->json();
    }

    public function get()
    {
        if ($this->id == null)
        {
            throw new RunTimeException('Dataset ID Required');
        }

        $response = Zttp::get($this->getUrl($this->currentType, $this->id));

        return $response->json();
    }

    public function update($data)
    {
        if ($this->id == null)
        {
            throw new RunTimeException('Dataset ID Required');
        }

        $response = Zttp::patch($this->getUrl($this->currentType, $this->id), $data);

        return $response->json();
    }

    public function delete()
    {
        if ($this->id == null)
        {
            throw new RunTimeException('Dataset ID Required');
        }

        return Zttp::delete($this->getUrl($this->currentType, $this->id));
    }

    public function features($featureID = null)
    {
        if ($this->currentType !== Mapbox::DATASET)
        {
            throw new RunTimeException('Features only work with Datasets');
        }

        if ($this->id == null)
        {
            throw new RunTimeException('Dataset ID Required');
        }

        return new MapboxFeatures($this->id, $featureID);
    }

    /**
     * Get Temporary S3 Credentials (UPLOADS ONLY)
     */
    public function credentials()
    {
        if ($this->currentType !== Mapbox::UPLOAD)
        {
            throw new RunTimeException('Credentials only work with Uploads');
        }

        $response = Zttp::get($this->getUrl($this->currentType, null, ['credentials']));

        return new S3Credentials($response->json());
    }
}
