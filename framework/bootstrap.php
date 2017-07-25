<?php

namespace linkphp\boot;
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

//加载自动加载方法
require(CORE_PATH . 'Autoload.php');
//注册自动加载方法
Autoload::loadExtendAutoload();
Autoload::register(array('LinkSystemAutoload','classMapAutoload','namespaceAutoload','loaderClass'));
//注册错误和异常处理机制
Error::register();
//控制台初始化
Console::initialize();