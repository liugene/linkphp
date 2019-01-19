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
// |               站点应用入口文件
// +----------------------------------------------------------------------

//目录基础常量的定义
define('ROOT_PATH', dirname(dirname(__DIR__)) . '/');
//加载自动加载方法
require(ROOT_PATH . 'vendor/linkphp/loader/src/Loader.php');
//加载LinkPHP框架启动文件
$app = require_once(ROOT_PATH . 'src/bootstrap.php');

$app->event(
    'error',
    \app\provider\ErrorProvider::class
);

$app->event(
    'router',
    \app\provider\RouterProvider::class
);

$kernel = $app->make(app\Kernel::class);

$kernel->start()
    ->then(function () use ($kernel,$app){
        $kernel->setData($app->make(linkphp\router\Router::class)
            ->getReturnData());
    })->complete();

//只需要这么几句话就可以运行 !><!
//是不是很轻便呀 喵~
 
