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
// |               LinkPHP框架项目中的工厂类
// +----------------------------------------------------------------------=

namespace linkphp\boot;
class Factory{

    static protected $_object = [];
    
    /**
     * 生成模型的实例对象
     * @param $model_name string
     * @param object
     */
    
    public static function create($model_name){
        //存储已经存在的实话的的模型对象列表，下表模型名，值模型对象
        //判断当前模型是否已经实例化
        
        if(!isset(static::$_object[$model_name])){
            //没有实例化过
            static::$_object[$model_name] = new $model_name;
            //
        }
        return static::$_object[$model_name];
        
    }
}
