<?php

namespace linkphp\bootstrap;
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

 /**
  * 加载Composer自动加载
  */
 require(VENDOR_PATH . 'autoload.php');

 /**
  * 加载LinkPHP框架核心初始化类
  */
 require(CORE_PATH . 'Console' . EXT);

 require('extend/util/sms/drives/alidayu/TopSdk.php');

 Console::init();