<?php

namespace linkphp\boot;

use linkphp\boot\di\Container;

class Component
{

    static private $_instance;

    static private function container()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Container();
        }

        return self::$_instance;
    }

    static public function __callStatic($method,$param)
    {
        return call_user_func_array([self::container(), $method], $param);
    }

}