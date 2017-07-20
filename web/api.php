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
// |               接口应用入库文件
// +----------------------------------------------------------------------

//开启接口应用
define('APP_INTERFACE_ON',true);
//定义应用名
define('APP_NAMESPACE_NAME','api');
// 定义接口目录
define('APPLICATION_PATH', __DIR__ . '/../interface/');
//加载LinkPHP框架常量文件
require(dirname(__DIR__) . '/framework/define.php');
//加载LinkPHP框架启动文件
require(dirname(__DIR__) . '/framework/bootstrap.php');

//只需要这么几句话就可以运行 !><!
//是不是很轻便呀 喵~
