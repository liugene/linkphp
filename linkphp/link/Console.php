<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架初始化类               *
 * --------------------------------------------------*
 */

namespace Link;
use link\route\parsers;
use System\Core\Engine;
use System\SQL\SQLVI;
class Console
{
    /**
     * 入口
     */
     static public function start()
     {

        /**
         * 运行自定义错误处理方式
         */
         require CORE_PATH . 'ErrorHandler' . EXT;
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
          * 加载LinkPHP框架系统、应用公共函数
          */
         /**
          * 加载LinkPHP框架系统函数
          */
         require LINKPHP_PATH . 'Common.php';
         /**
          * 加载LinkPHP框架应用函数库
          */
         require COMMON_PATH . 'Function/Common.php';
        /**
         * 注册自动加载方法
         */
         /**
          * 加载自动加载方法
          */
         require CORE_PATH . 'Autoload' . EXT;
         /**
          * 注册自动加载方法
          */
         Autoload::addNamespace(C('AUTOLOAD_NAMESPACE'));
         Autoload::register(array('LinkSystemAutoload','toolClassAutoload','namespaceAutoload','loaderClass'));
        /**
         * 加载系统引擎机制
         */
         Engine::run();
        /**
         * 加载系统视图索引
         */
         SQLVI::run();
        /**
         * 路由参数初始化
         */
         parsers::start();

     }

}
