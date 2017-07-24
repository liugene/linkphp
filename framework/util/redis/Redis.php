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
// |               配置类
// +----------------------------------------------------------------------

namespace util\redis;

class Redis
{
    static public $_link;
    public function __construct()
    {
        static::connect();
    }

    static private function connect()
    {
        static::$_link = new \Redis();
        static::$_link->connect('127.0.0.1',6379);
        return static::$_link;
    }

}