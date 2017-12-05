<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Latham <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               路由分发
// +----------------------------------------------------------------------

namespace linkphp\boot\router;
class Dispatch
{

    //分发类构造函数
    static public function init($config)
    {
        static::_dispatch($config);
    }

    //分发方法
    static private function _dispatch($config)
    {
        $dir = $config['__APP__'] . 'controllers/' . PLATFORM;
        //判断模块是否存在
        if(!is_dir($dir)){
            //抛出异常
            throw new \Exception("无法加载模块");
        }
        //实例化控制器类
        $controller_name = APP_NAMESPACE_NAME  . '\controllers\\' . PLATFORM . '\\' . CONTROLLER;
        $filename = str_replace('\\','/',$config['__APP__'] . 'controllers' . '/' . PLATFORM . '/' . CONTROLLER  . EXT);
        if(file_exists($filename)){
            $controller = new $controller_name;
        } else {
            //抛出异常
            throw new \Exception("无法加载控制器");
        }
        //调用方法
        $action_name = ACTION;
        if(method_exists($controller,$action_name)){
            $controller -> $action_name();
        } else {
            //抛出异常
            throw new \Exception("无法加载方法");
        }
    }
}

?>