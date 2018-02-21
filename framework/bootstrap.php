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

namespace linkphp;

use linkphp\boot\Component;
use linkphp\boot\Definition;
use linkphp\boot\Autoload;
use linkphp\boot\Error;

//加载自动加载方法
require(CORE_PATH . 'Autoload.php');
//注册自动加载方法
Autoload::register();
//注册错误和异常处理机制
Error::register();

Application::run()->request()->check(
    IS_CLI ?
    Application::env()
        ->selectEnvModel(
            Component::bind((new Definition())
            ->setAlias('envmodel')
            ->setIsSingleton(true)
                ->setCallBack(function(){
                    Component::bind((new Definition())
                        ->setAlias('run')
                        ->setIsEager(true)
                        ->setIsSingleton(true)
                        ->setClassName('linkphp\boot\Command'));
                    return Component::get('run');
            })
        )) :
    Application::env()
        ->selectEnvModel(
            Component::bind((new Definition())
            ->setAlias('envmodel')
            ->setIsSingleton(true)
                ->setCallBack(function(){
                    Component::bind((new Definition())
                        ->setAlias('run')
                        ->setIsEager(true)
                        ->setIsSingleton(true)
                        ->setClassName('linkphp\boot\Router'));
                    return Component::get('run');
                })
        ))
)->response();