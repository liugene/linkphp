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

$loader = new \linkphp\loader\Loader();

//注册自动加载方法
$loader->register(
    $loader->import(include_once(LOAD_PATH . 'map.php'))
        ->setVendorPath(VENDOR_PATH)
        ->setLoadPath(LOAD_PATH)
        ->setExtendPath(EXTEND_PATH)
        ->setFrameWorkPath(FRAMEWORK_PATH)
        ->setExt(EXT)
)->complete();

$app = new \linkphp\Application();

$app->event(
    'system',
    [
        \linkphp\event\provider\ErrorProvider::class,
        \linkphp\event\provider\ConfigProvider::class,
        \linkphp\event\provider\MiddleProvider::class,
        \linkphp\event\provider\DatabaseProvider::class,
    ]
);

$app->containerInstance(
    \linkphp\loader\Loader::class,
    $loader
);

$app->containerInstance(
    \linkphp\Application::class,
    $app
);

//应用周期
$app->run();

return $app;