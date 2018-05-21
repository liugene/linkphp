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
define('ROOT_PATH', dirname(__DIR__) . '/');
//加载LinkPHP框架常量文件
require(ROOT_PATH . 'vendor/linkphp/framework/src/define.php');
//加载自动加载方法
require(VENDOR_PATH . 'linkphp/loader/src/Loader.php');
//加载LinkPHP框架启动文件
require(APPLICATION_PATH . 'bootstrap.php');

//只需要这么几句话就可以运行 !><!
//是不是很轻便呀 喵~
 
