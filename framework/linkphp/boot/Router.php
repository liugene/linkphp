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
// |               路由解释器
// +----------------------------------------------------------------------

namespace linkphp\boot;

use linkphp\boot\router\Init;
use linkphp\boot\router\Dispatch;
use linkphp\boot\router\config\Config;

class Router
{

    /**
     * 路由解析启动
     */
    static public function initialize()
    {
        $config = Config::get();
        Init::init($config);
        static::_initPlatformPathConst($config);
        Dispatch::init($config);
    }

    /**
     * 声明当前平台路径常量
     */
    static private function _initPlatformPathConst($config)
    {
        /**
         * 定义控制器路径常量
         */
        define('CURRENT_CONTROLLER_PATH',$config['__APP__'] . 'controllers/' . PLATFORM);
        /**
         * 定义模型路径常量
         */
        define('CURRENT_MODEL_PATH', $config['__APP__'] . 'models/' . PLATFORM);
        /**
         * 定义视图路径常量
         */
        define('CURRENT_VIEW_PATH', $config['__APP__'] . 'views/' . PLATFORM);

    }
}