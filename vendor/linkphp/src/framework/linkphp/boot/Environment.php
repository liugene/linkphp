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
        return $this;
    }

    public function requestRouterHandle()
    {
        /**
         * 设置应用启动中间件并监听执行
         */
        Application::hook('appMiddleware');
        Application::get('envmodel')
            ->init()
            ->run(
            Application::router()
                ->import(require LOAD_PATH . 'route.php')
                ->set(
                    Application::router()
                        ->setUrlModel('1')
                        ->setPath(
                            Application::input('server.REQUEST_URI')
                        )
                        ->setDefaultPlatform('main')
                        ->setDefaultController('Home')
                        ->setDefaultAction('main')
                        ->setVarPlatform('m')
                        ->setVarController('c')
                        ->setVarAction('a')
                        ->setRouterOn('true')
                        ->setGetParam(Application::input('get.'))
                        ->setPlatform('')
                        ->setController('')
                        ->setAction('')
                        ->setDir(APPLICATION_PATH)
                        ->setNamespace(APP_NAMESPACE_NAME)
                )
                ->parser()
                ->dispatch()
        );
        return $this;
    }

    public function requestCmdHandle()
    {
        Application::httpRequest()
            ->setCmdParam(
                Application::input('server.argv')
            );
        Application::get('envmodel')->init();
        return $this;
    }

}