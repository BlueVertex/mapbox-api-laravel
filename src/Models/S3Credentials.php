<?php

namespace BlueVertex\MapBoxAPILaravel\Models;

class S3Credentials extends JSONModel
{
    public $accessKeyId;
    public $bucket;
    public $key;
    public $secretAccessKey;
    public $sessionToken;
    public $url;

    public function jsonSerialize()
    {
        return [
            'accessKeyId'     => $this->accessKeyId,
            'bucket'          => $this->bucket,
            'key'             => $this->key,
            'secretAccessKey' => $this->secretAccessKey,
            'sessionToken'    => $this->sessionToken,
            'url'             => $this->url
        ];
    }
}
