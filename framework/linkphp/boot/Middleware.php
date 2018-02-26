<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               中间件
// +----------------------------------------------------------------------

namespace linkphp\boot;

use linkphp\boot\middleware\Middleware as Middle;

class Middleware
{

    static private $_instance;

    static private function middleware()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Middle();
        }

        return self::$_instance;
    }

    static public function __callStatic($method,$param)
    {
        return call_user_func_array([self::middleware(), $method], $param);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([self::middleware(), $name], $arguments);
    }

}
