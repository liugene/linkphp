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
// |               框架启动调度类
// +----------------------------------------------------------------------

namespace linkphp\boot;
use system\core\Engine;

class Console
{

    //控制台初始化
    static public function initialize()
    {
        //系统引擎机制初始化
        Engine::initialize();
        //判断运行环境模式
        static::checkEnvMode();
    }

    //检测运行环境
    static public function checkEnvMode()
    {
        //判断是否为命令行模式
        if(IS_CLI){
            //命令行模式初始化操作
            Command::initialize();
        } else {
            //路由初始化
            Router::initialize();
        }
    }

}

