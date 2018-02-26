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

namespace linkphp\boot;
use linkphp\Application;

class Environment
{

    static private $_instance;

    private $_request;

    private $_env;

    static public function getInstance()
    {
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //操作相应模式
    public function selectEnvModel($_env_object)
    {
        $this->_env = Application::get('envmodel');
        $this->_request = Application::get('request')->request();
        return $this;
    }

    public function requestRouterHandle()
    {
        /**
         * 设置应用启动中间件并监听执行
         */
        Application::hook('appMiddleware');
        $this->_env->initialize();
        return $this;
    }

    public function requestCmdHandle()
    {
        $this->_request->setCmdParam(Application::input('server.argv'));
        $this->_env->initialize();
        return $this;
    }

}