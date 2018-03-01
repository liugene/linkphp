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

use linkphp\Application;

class Dispatch
{

    //分发方法
    public function dispatch(Router $router)
    {
        Application::hook('modelMiddleware');
        $dir = $router->getDir() . 'controller/' . $router->getPlatform();
        //判断模块是否存在
        if(!is_dir($dir)){
            //抛出异常
            throw new \Exception("无法加载模块");
        }
        //实例化控制器类
        $controller_name = $router->getNamespace()  . '\controller\\' . $router->getPlatform() . '\\' . $router->getController();
        $filename = str_replace('\\','/',$dir . '/' . $router->getController()  . '.php');
        if(file_exists($filename)){
            Application::bind(Application::definition()
                ->setAlias($controller_name)
                ->setIsSingleton(true)
                ->setClassName($controller_name));
        } else {
            //抛出异常
            throw new \Exception("无法加载控制器");
        }
        //调用方法
        $action_name = $router->getAction();
        Application::hook('controllerMiddleware');
        $controller = Application::get($controller_name);
        if(method_exists($controller,$action_name)){
            Application::hook('actionMiddleware');
            $router->setReturnData($controller->$action_name());
        } else {
            //抛出异常
            throw new \Exception("无法加载方法");
        }
    }
}