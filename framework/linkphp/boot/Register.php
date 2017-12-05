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
// |               注册器模式
// +----------------------------------------------------------------------

namespace linkphp\boot;
class Register
{
    static protected $_object = [];

    //注册实例
    static public function set($alias,$object)
    {
        if(!isset(static::$_object[$alias])){
            static::$_object[$alias] = $object;
        }
        return static::$_object[$alias];
    }

    //移除实例
    static public function remove($alias)
    {
        unset(static::$_object[$alias]);
    }

    //获取实例
    static public function get($alias)
    {
        return static::$_object[$alias];
    }

}