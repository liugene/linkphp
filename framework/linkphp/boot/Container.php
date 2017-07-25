<?php

namespace linkphp\boot;
// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Latham <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               依赖注入容器
// +----------------------------------------------------------------------

class Container
{

    //存储类的定义
    static private $_definitions = [];

    //存储类实例化所需要的参数
    static private $_params = [];

    //存储类与类的依赖
    static private $_dependencies = [];


    /*
     * 设置依赖
     * @param string $class 类、方法、名称
     * @param array $defination 类、方法、定义
     * @param array $params 类、方法初始化所需要的参数
     * */

    static public function set($class,$defination = [],$params = [])
    {
        static::$_params[$class] = $params;
        static::$_definitions[$class] = $defination;
    }


}