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
    //私有静态保存链接对象
    static public $_link;

    //私有化构造函数
    static private function __construct()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
    }

    //私有化克隆函数
    static private function __clone(){}

    static public function getConnect()
    {
        if(!self::$_link){
            self::$_link = new self();
        }
        return self::$_link;
    }

}