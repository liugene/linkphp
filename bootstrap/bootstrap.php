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
// |               LinkPHP框架启动文件
// +----------------------------------------------------------------------

use linkphp\Application;
use linkphp\loader\Loader;

//注册自动加载方法
Loader::register(
    Loader::instance()
        ->import(include_once(LOAD_PATH . 'map.php'))
        ->setVendorPath(VENDOR_PATH)
        ->setLoadPath(LOAD_PATH)
        ->setExtendPath(EXTEND_PATH)
        ->setFrameWorkPath(FRAMEWORK_PATH)
        ->setExt(EXT)
)->complete();
//注册服务提供者
Application::event(
    'system',
    [
    \linkphp\event\provider\ErrorProvider::class,
    \linkphp\event\provider\ConfigProvider::class,
    \linkphp\event\provider\MiddleProvider::class,
    \linkphp\event\provider\DatabaseProvider::class,
    ]
);
//应用周期
Application::run()
    ->request()
    ->check(
        IS_CLI ?
            Application::env()
                ->selectEnvModel(
                    Application::singleton(
                        'envmodel',
                        function(){
                            Application::singletonEager(
                                'run',
                                'linkphp\console\Command'
                            );
                            return Application::get('run');
                        })
                )->requestCmdHandle() :
            Application::env()
                ->selectEnvModel(
                    Application::singleton(
                        'envmodel',
                        function(){
                            Application::singletonEager(
                                'run',
                                'linkphp\router\Router'
                            );
                            return Application::get('run');
                        })
                )->requestRouterHandle()
    )->response();