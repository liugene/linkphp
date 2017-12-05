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
use linkphp\system\core\Engine;
use linkphp\boot\env\CommandEnv;
use linkphp\boot\env\NormalEnv;

class Console
{

    static private $_env_object;

    //控制台初始化
    static public function initialize($_env_object)
    {
        static::$_env_object = $_env_object;
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
            Env::setStrategy(new CommandEnv);
        } else {
            //路由初始化
            Env::setStrategy(new NormalEnv);
        }
        static::$_env_object->selectEnvModel();
    }

}

