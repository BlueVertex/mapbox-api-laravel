<?php

namespace BlueVertex\MapBoxAPILaravel\Models;

use JsonSerializable;

abstract class JSONModel implements JsonSerializable
{
    public function __construct($data)
    {
        foreach($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }
}
