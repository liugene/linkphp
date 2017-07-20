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
// |               LinkPHP框架初始化类
// +----------------------------------------------------------------------

use linkphp\bootstrap\Router;
use system\core\Engine;

class Console
{
    /**
     * 入口
     */
     static public function init()
     {

        /**
         * 运行自定义错误处理方式
         */
         require(CORE_PATH . 'ErrorHandler' . EXT);

         /**
          * 捕获致命错误自定义处理方法
          */
         register_shutdown_function(array('ErrorHandler','dealFatalError'));

         /**
          * 捕获普通自定义处理方法
          */
         set_error_handler(array('ErrorHandler','linkErrorFunc'));

         /**
          * 捕获异常自定义处理方法
          */
         set_exception_handler(array('ErrorHandler','dealException'));

         /**
          * 加载LinkPHP框架系统函数
          */
         require(LINKPHP_PATH . 'functions.php');

         /**
          * 加载LinkPHP框架应用函数库
          */
         require(APPLICATION_PATH . 'functions.php');

        /**
         * 注册自动加载方法
         * 加载自动加载方法
         */
         require(CORE_PATH . 'Autoload' . EXT);
         /**
          * 注册自动加载方法
          */
         Autoload::addNamespace(C('autoload_namespace'));
         Autoload::register(array('LinkSystemAutoload','classMapAutoload','namespaceAutoload','loaderClass'));

        /**
         * 加载系统引擎机制
         */
         Engine::init();

        /**
         * 命令行模式初始化操作
         */
         Command::init();

        /**
         * 路由参数初始化
         */
         Router::init();
     }

}
