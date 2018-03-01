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

namespace bootstrap;

use linkphp\boot\Error;
use linkphp\boot\Config;
use linkphp\Application;

//加载自动加载方法
require('Autoload.php');
//注册自动加载方法
Autoload::register(
    Autoload::instance()
        ->setVendorPath(VENDOR_PATH)
        ->setLoadPath(LOAD_PATH)
        ->setExtendPath(EXTEND_PATH)
        ->setFrameWorkPath(FRAMEWORK_PATH)
        ->setExt(EXT)
)->complete();
//注册错误和异常处理机制
Error::register(
    Error::instance()
        ->setErrorView(EXTRA_PATH . 'tpl/error.html')
        ->setDebug(true)
        ->setErrHandle('')
)->complete();
//配置文件加载
Config::set(
    Config::instance()
        ->setLoadPath(LOAD_PATH)
)->import(require FRAMEWORK_PATH . 'configure.php');

Application::run()->request()->check(
    IS_CLI ?
    Application::env()
        ->selectEnvModel(
            Application::bind(
                Application::definition()
                    ->setAlias('envmodel')
                    ->setIsSingleton(true)
                    ->setCallBack(function(){
                        Application::bind(
                            Application::definition()
                                ->setAlias('run')
                                ->setIsEager(true)
                                ->setIsSingleton(true)
                                ->setClassName('linkphp\boot\Command'));
                        return Application::get('run');
            })
        ))->requestCmdHandle() :
    Application::env()
        ->selectEnvModel(
            Application::bind(
                Application::definition()
                    ->setAlias('envmodel')
                    ->setIsSingleton(true)
                    ->setCallBack(function(){
                        Application::bind(
                            Application::definition()
                                ->setAlias('run')
                                ->setIsEager(true)
                                ->setIsSingleton(true)
                                ->setClassName('linkphp\boot\Router'));
                        return Application::get('run');
                })
        ))->requestRouterHandle()
)->response();