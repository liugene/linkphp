<?php

namespace linkphp\boot;

use ArrayAccess;

class Collection implements ArrayAccess
{

    private $collect = [];

    public function collect($array)
    {
        $this->collect = $array;
        return $this;
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}
