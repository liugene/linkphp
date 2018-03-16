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

//注册自动加载方法
\linkphp\loader\Loader::register(
    \linkphp\loader\Loader::instance()
        ->import(include_once(LOAD_PATH . 'map.php'))
        ->setVendorPath(VENDOR_PATH)
        ->setLoadPath(LOAD_PATH)
        ->setExtendPath(EXTEND_PATH)
        ->setFrameWorkPath(FRAMEWORK_PATH)
        ->setExt(EXT)
)->complete();
//注册服务提供者
\linkphp\Application::event(
    'system',
    [
    \linkphp\event\provider\ErrorProvider::class,
    \linkphp\event\provider\ConfigProvider::class,
    \linkphp\event\provider\MiddleProvider::class,
    \linkphp\event\provider\DatabaseProvider::class,
    ]
);
//应用周期
\linkphp\Application::run()
    ->request()
    ->check(
        IS_CLI ?
            \linkphp\Application::env()
                ->selectEnvModel(
                    \linkphp\Application::singleton(
                        'envmodel',
                        function(){
                            \linkphp\Application::singletonEager(
                                'run',
                                'linkphp\console\Command'
                            );
                            return \linkphp\Application::get('run');
                        })
                )->requestCmdHandle() :
            \linkphp\Application::env()
                ->selectEnvModel(
                    \linkphp\Application::singleton(
                        'envmodel',
                        function(){
                            \linkphp\Application::singletonEager(
                                'run',
                                'linkphp\router\Router'
                            );
                            return \linkphp\Application::get('run');
                        })
                )->requestRouterHandle()
    )->response();